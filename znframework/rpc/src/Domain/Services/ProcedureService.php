<?php

namespace ZnFramework\Rpc\Domain\Services;

use Illuminate\Container\EntryNotFoundException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnCore\Contract\User\Exceptions\ForbiddenException;
use ZnCore\Contract\User\Exceptions\UnauthorizedException;
use ZnCore\EventDispatcher\Traits\EventDispatcherTrait;
use ZnCore\Instance\Libs\InstanceProvider;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnDomain\QueryFilter\Exceptions\BadFilterValidateException;
use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnDomain\Validator\Helpers\ErrorCollectionHelper;
use ZnFramework\Rpc\Domain\Entities\MethodEntity;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnFramework\Rpc\Domain\Enums\HttpHeaderEnum;
use ZnFramework\Rpc\Domain\Enums\RpcErrorCodeEnum;
use ZnFramework\Rpc\Domain\Enums\RpcEventEnum;
use ZnFramework\Rpc\Domain\Events\RpcRequestEvent;
use ZnFramework\Rpc\Domain\Events\RpcResponseEvent;
use ZnFramework\Rpc\Domain\Exceptions\InvalidRequestException;
use ZnFramework\Rpc\Domain\Exceptions\RpcMethodNotFoundException;
use ZnFramework\Rpc\Domain\Exceptions\SystemErrorException;
use ZnFramework\Rpc\Domain\Helpers\RequestHelper;
use ZnFramework\Rpc\Domain\Interfaces\Services\MethodServiceInterface;
use ZnFramework\Rpc\Domain\Interfaces\Services\ProcedureServiceInterface;
use ZnFramework\Rpc\Domain\Libs\ResponseFormatter;
use ZnFramework\Rpc\Domain\Subscribers\ApplicationAuthenticationSubscriber;
use ZnFramework\Rpc\Domain\Subscribers\CheckAccessSubscriber;
use ZnFramework\Rpc\Domain\Subscribers\CryptoProviderSubscriber;
use ZnFramework\Rpc\Domain\Subscribers\LanguageSubscriber;
use ZnFramework\Rpc\Domain\Subscribers\LogSubscriber;
use ZnFramework\Rpc\Domain\Subscribers\RpcFirewallSubscriber;
use ZnFramework\Rpc\Domain\Subscribers\TimestampSubscriber;
use ZnLib\Components\Http\Enums\HttpStatusCodeEnum;

class ProcedureService implements ProcedureServiceInterface
{

    use EventDispatcherTrait;

    private $methodService;
    private $responseFormatter;
    private $instanceProvider;

    public function __construct(
        ResponseFormatter $responseFormatter,
        MethodServiceInterface $methodService,
        EventDispatcherInterface $dispatcher,
        InstanceProvider $instanceProvider
    )
    {
        set_error_handler([$this, 'errorHandler']);
        $this->responseFormatter = $responseFormatter;
        $this->methodService = $methodService;
        $this->setEventDispatcher($dispatcher);
        $this->instanceProvider = $instanceProvider;
    }

    public function subscribes_____________(): array
    {
        return [
            ApplicationAuthenticationSubscriber::class, // Аутентификация приложения
            RpcFirewallSubscriber::class, // Аутентификация пользователя
            CheckAccessSubscriber::class, // Проверка прав доступа
            TimestampSubscriber::class, // Проверка метки времени запроса и подстановка метки времени ответа
            CryptoProviderSubscriber::class, // Проверка подписи запроса и подписание ответа
            LogSubscriber::class, // Логирование запроса и ответа
            LanguageSubscriber::class, // Обработка языка
        ];
    }

    public function callOneProcedure(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        try {
            RequestHelper::validateRequest($requestEntity);

            $version = $requestEntity->getMetaItem(HttpHeaderEnum::VERSION);
            if (empty($version)) {
                throw new InvalidRequestException('Empty method version');
            }

            try {
                $methodEntity = $this->methodService->findOneByMethodName($requestEntity->getMethod(), $version);
            } catch (RpcMethodNotFoundException $e) {
                $this->triggerNotFoundHandler($requestEntity);
                throw $e;
            }

            $this->triggerBefore($requestEntity, $methodEntity);
            $parameters = [
                RpcRequestEntity::class => $requestEntity
            ];
            $responseEntity = $this->instanceProvider->callMethod($methodEntity->getHandlerClass(), [], $methodEntity->getHandlerMethod(), $parameters);
        } catch (NotFoundException $e) {
            $responseEntity = $this->responseFormatter->forgeErrorResponse(HttpStatusCodeEnum::NOT_FOUND, $e->getMessage(), EntityHelper::toArray($e), $e);
        } catch (UnprocessibleEntityException $e) {
            $responseEntity = $this->handleUnprocessibleEntityException($e);
        } catch (UnauthorizedException $e) {
            $message = $e->getMessage() ?: 'Unauthorized';
            $responseEntity = $this->responseFormatter->forgeErrorResponse(HttpStatusCodeEnum::UNAUTHORIZED, $message, EntityHelper::toArray($e), $e);
        } catch (ForbiddenException $e) {
            $responseEntity = $this->responseFormatter->forgeErrorResponse(HttpStatusCodeEnum::FORBIDDEN, $e->getMessage(), EntityHelper::toArray($e), $e);
        } catch (EntryNotFoundException $e) {
            $message = 'Server error. Bad inject dependencies in "' . $e->getMessage() . '"';
            $responseEntity = $this->responseFormatter->forgeErrorResponse(RpcErrorCodeEnum::SYSTEM_ERROR, $message, EntityHelper::toArray($e), $e);
        } catch (\Throwable $e) {
            $code = $e->getCode() ?: RpcErrorCodeEnum::APPLICATION_ERROR;
            $message = $e->getMessage() ?: 'Application error: ' . get_class($e);
            $responseEntity = $this->responseFormatter->forgeErrorResponse(intval($code), $message, null, $e);
        }
        $responseEntity->setId($requestEntity->getId());
        $this->triggerAfter($requestEntity, $responseEntity);
        return $responseEntity;
    }

    public function errorHandler($error_level, $error_message, $error_file, $error_line)
    {
        $message = $error_message . ' in ' . $error_file . ':' . $error_line;
        throw new SystemErrorException($message);
    }

    private function triggerNotFoundHandler(RpcRequestEntity $requestEntity)
    {
        $requestEvent = new RpcRequestEvent($requestEntity);
        $this->getEventDispatcher()->dispatch($requestEvent, RpcEventEnum::METHOD_NOT_FOUND);
    }

    private function triggerBefore(RpcRequestEntity $requestEntity, MethodEntity $methodEntity)
    {
        $requestEvent = new RpcRequestEvent($requestEntity, $methodEntity);
        $this->getEventDispatcher()->dispatch($requestEvent, RpcEventEnum::BEFORE_RUN_ACTION); // todo: deprecated

        $this->getEventDispatcher()->dispatch($requestEvent, KernelEvents::REQUEST);
    }

    private function triggerAfter(RpcRequestEntity $requestEntity, RpcResponseEntity $responseEntity)
    {
        $responseEvent = new RpcResponseEvent($requestEntity, $responseEntity);
        $this->getEventDispatcher()->dispatch($responseEvent, RpcEventEnum::AFTER_RUN_ACTION);
    }

    private function handleUnprocessibleEntityException(UnprocessibleEntityException $e): RpcResponseEntity
    {
        $errorData = ErrorCollectionHelper::collectionToArray($e->getErrorCollection());
        if ($e instanceof BadFilterValidateException) {
            $message = 'Filter parameter validation error';
        } else {
            $message = 'Parameter validation error';
        }
        return $this->responseFormatter->forgeErrorResponse(RpcErrorCodeEnum::SERVER_ERROR_INVALID_PARAMS, $message, $errorData);
    }
}
