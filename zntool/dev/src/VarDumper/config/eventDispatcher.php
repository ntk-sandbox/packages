<?php

use Untek\Core\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use Untek\Tool\Dev\VarDumper\Subscribers\SymfonyDumperSubscriber;

return function (EventDispatcherConfiguratorInterface $configurator): void {

    /** Подключаем дампер */
    $configurator->addSubscriber(SymfonyDumperSubscriber::class);
};
