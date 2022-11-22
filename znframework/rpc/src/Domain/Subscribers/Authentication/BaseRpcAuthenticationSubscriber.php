<?php

namespace ZnFramework\Rpc\Domain\Subscribers\Authentication;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Enums\RpcEventEnum;
use ZnFramework\Rpc\Domain\Events\RpcRequestEvent;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;

abstract class BaseRpcAuthenticationSubscriber implements EventSubscriberInterface
{

    protected AuthServiceInterface $authService;
    protected Security $security;

    public function __construct(AuthServiceInterface $authService, Security $security)
    {
        $this->authService = $authService;
        $this->security = $security;
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
        /*if($this->authService->getIdentity()) {
            return;
        }*/
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
    abstract protected function getToken(RpcRequestEntity $requestEntity): ?string;

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
