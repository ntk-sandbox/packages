<?php

use Psr\Container\ContainerInterface;
use Symfony\Component\Security\Core\User\ChainUserProvider;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use ZnUser\Authentication\Domain\Enums\CredentialTypeEnum;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use ZnUser\Authentication\Domain\Services\AuthService;
use ZnUser\Authentication\Domain\Subscribers\SymfonyAuthenticationIdentitySubscriber;
use ZnUser\Authentication\Domain\UserProviders\ApiTokenUserProvider;
use ZnUser\Authentication\Domain\UserProviders\CredentialsUserProvider;

return [
    'singletons' => [
//        UserProviderInterface::class => \ZnUser\Authentication\Domain\UserProviders\ApiTokenUserProvider::class,
        UserProviderInterface::class => function (ContainerInterface $container) {
            /** @var CredentialsUserProvider $credentialsUserProvider */
            $credentialsUserProvider = $container->get(CredentialsUserProvider::class);
            $credentialsUserProvider->setTypes(
                [
                    CredentialTypeEnum::LOGIN,
                    CredentialTypeEnum::EMAIL,
                    CredentialTypeEnum::PHONE
                ]
            );
            $providers = [];
            $providers[] = $container->get(ApiTokenUserProvider::class);
            $providers[] = $credentialsUserProvider;

            return new ChainUserProvider($providers);
        },

        AuthServiceInterface::class => function (ContainerInterface $container) {
            /** @var AuthService $authService */
            $authService = $container->get(AuthService::class);
//            $authService->addSubscriber(SymfonyAuthenticationIdentitySubscriber::class);
            /*$authService->addSubscriber(
                [
                    'class' => \ZnUser\Authentication\Domain\Subscribers\AuthenticationAttemptSubscriber::class,
                    'action' => 'authorization',
                    // todo: вынести в настройки
                    'attemptCount' => 3,
                    'lifeTime' => 10,
//                'lifeTime' => TimeEnum::SECOND_PER_MINUTE * 30,
                ]
            );*/
            return $authService;
        },
    ],
];
