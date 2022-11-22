<?php

namespace ZnFramework\Rpc\Domain\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use ZnCore\Code\Helpers\DeprecateHelper;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Enums\HttpHeaderEnum;
use ZnFramework\Rpc\Domain\Enums\RpcEventEnum;
use ZnFramework\Rpc\Domain\Events\RpcRequestEvent;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;

DeprecateHelper::hardThrow();

class RpcFirewallSubscriber implements EventSubscriberInterface
{

    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
            RpcEventEnum::BEFORE_RUN_ACTION => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(RpcRequestEvent $event)
    {
        $requestEntity = $event->getRequestEntity();
        $methodEntity = $event->getMethodEntity();
        if ($methodEntity->getIsVerifyAuth()) {
            $this->userAuthentication($requestEntity);
        }
    }

    /**
     * Получить токен
     *
     * @param RpcRequestEntity $requestEntity
     * @return string|null
     */
    protected function getToken(RpcRequestEntity $requestEntity): ?string
    {
        $authorization = Request::createFromGlobals()->headers->get('authorization');
        if (empty($authorization)) {
            $authorization = $requestEntity->getMetaItem(HttpHeaderEnum::AUTHORIZATION);
        }
        return $authorization;
    }

    /**
     * Аутентификация пользователя
     * @param RpcRequestEntity $requestEntity
     * @throws AuthenticationException
     */
    protected function userAuthentication(RpcRequestEntity $requestEntity)
    {
        $authorization = $this->getToken($requestEntity);
        if (empty($authorization)) {
            throw new AuthenticationException('Empty token');
        }
        try {
            $identity = $this->authService->authenticationByToken($authorization);
            $this->authService->setIdentity($identity);
        } catch (NotFoundException $e) {
            throw new AuthenticationException('Bad token');
        }
    }
}
