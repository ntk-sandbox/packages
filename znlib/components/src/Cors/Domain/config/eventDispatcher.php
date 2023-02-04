<?php

use Untek\Core\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use Untek\Lib\Components\Cors\Subscribers\CorsSubscriber;

return function(EventDispatcherConfiguratorInterface $configurator): void
{
    $configurator->addSubscriber(CorsSubscriber::class); // Обработка CORS-запросов
};
