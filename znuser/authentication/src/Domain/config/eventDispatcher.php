<?php

use ZnCore\Env\Helpers\EnvHelper;
use ZnCore\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;

return function (EventDispatcherConfiguratorInterface $configurator): void {
    if(EnvHelper::isWeb()) {
        $configurator->addSubscriber(\ZnUser\Authentication\Domain\Subscribers\SymfonyAuthenticationIdentitySubscriber::class);
    }
    /*$configurator->addSubscriber(
        [
            'class' => \ZnUser\Authentication\Domain\Subscribers\AuthenticationAttemptSubscriber::class,
            'action' => 'authorization',
            // todo: вынести в настройки
            'attemptCount' => 3,
            'lifeTime' => 10,
//                'lifeTime' => TimeEnum::SECOND_PER_MINUTE * 30,
        ]
    );*/
};
