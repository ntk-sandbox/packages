<?php

use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use ZnUser\Authentication\Domain\Services\AuthService;
use ZnUser\Authentication\Domain\Subscribers\SymfonyAuthenticationIdentitySubscriber;

return [
    'singletons' => [
        AuthServiceInterface::class => function (ContainerInterface $container) {
            /** @var AuthService $authService */
            $authService = $container->get(AuthService::class);
            $authService->addSubscriber(SymfonyAuthenticationIdentitySubscriber::class);
            $authService->addSubscriber(
                [
                    'class' => \ZnUser\Authentication\Domain\Subscribers\AuthenticationAttemptSubscriber::class,
                    'action' => 'authorization',
                    // todo: вынести в настройки
                    'attemptCount' => 3,
                    'lifeTime' => 10,
//                'lifeTime' => TimeEnum::SECOND_PER_MINUTE * 30,
                ]
            );
            return $authService;
        },
    ],
];
