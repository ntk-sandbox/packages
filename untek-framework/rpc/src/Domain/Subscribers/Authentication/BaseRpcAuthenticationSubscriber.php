<?php

namespace Untek\Framework\Rpc\Domain\Subscribers\Authentication;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\NullToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Enums\RpcEventEnum;
use Untek\Framework\Rpc\Domain\Events\RpcRequestEvent;
use Untek\User\Authentication\Domain\Authentication\Token\ApiToken;
use Untek\User\Authentication\Domain\Interfaces\Services\AuthServiceInterface;

abstract class BaseRpcAuthenticationSubscriber implements EventSubscriberInterface
{

//    protected AuthServiceInterface $authService;
//    protected Security $security;

    public function __construct(
//        AuthServiceInterface $authService,
        protected TokenStorageInterface $tokenStorage,
        protected UserProviderInterface $userProvider
//        Security $security
    )
    {
//        $this->authService = $authService;
//        $this->security = $security;
    }

    public static function getSubscribedEvents(): array
    {
        return [
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
    abstract protected function getToken(RpcRequestEntity $requestEntity): ?string;

    /**
     * Аутентификация пользователя
     * @param RpcRequestEntity $requestEntity
     * @throws AuthenticationException
     */
    protected function userAuthentication(RpcRequestEntity $requestEntity)
    {
        $credentials = $this->getToken($requestEntity);
        if (empty($credentials)) {
            throw new AuthenticationException('Empty token');
        }
        try {
            $identity = $this->userProvider->loadUserByIdentifier($credentials);
//            $identity = $this->authService->authenticationByToken($credentials);
            $token = new ApiToken($identity, 'main', $identity->getRoles(), $credentials);
            $this->tokenStorage->setToken($token);
//            $this->authService->setIdentity($identity);
        } catch (UserNotFoundException $e) {
            throw new AuthenticationException('Bad token');
        }
    }
}
