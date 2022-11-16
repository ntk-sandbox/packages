<?php

use ZnCore\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use ZnLib\Components\Cors\Subscribers\CorsSubscriber;

return function(EventDispatcherConfiguratorInterface $configurator): void
{
    $configurator->addSubscriber(CorsSubscriber::class); // Обработка CORS-запросов
};
