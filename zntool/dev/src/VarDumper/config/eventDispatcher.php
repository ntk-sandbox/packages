<?php

use ZnCore\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use ZnTool\Dev\VarDumper\Subscribers\SymfonyDumperSubscriber;

return function (EventDispatcherConfiguratorInterface $configurator): void {

    /** Подключаем дампер */
    $configurator->addSubscriber(SymfonyDumperSubscriber::class);
};
