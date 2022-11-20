<?php

use ZnCore\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use ZnSandbox\Sandbox\Debug\Domain\Subscribers\DebugSubscriber;

return function (EventDispatcherConfiguratorInterface $configurator): void {

    /** Подключаем отладку и профилирование */
    if(! \ZnCore\Env\Helpers\EnvHelper::isConsole()) {
        $configurator->addSubscriber(DebugSubscriber::class);
    }

};
