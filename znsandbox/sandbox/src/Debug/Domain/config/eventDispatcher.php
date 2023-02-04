<?php

use Untek\Core\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use Untek\Sandbox\Sandbox\Debug\Domain\Subscribers\DebugSubscriber;

return function (EventDispatcherConfiguratorInterface $configurator): void {

    /** Подключаем отладку и профилирование */
    if(! \Untek\Core\Env\Helpers\EnvHelper::isConsole()) {
        $configurator->addSubscriber(DebugSubscriber::class);
    }

};
