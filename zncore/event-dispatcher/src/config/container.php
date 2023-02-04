<?php

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Untek\Core\Container\Interfaces\ContainerConfiguratorInterface;
use Untek\Core\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use Untek\Core\EventDispatcher\Libs\EventDispatcherConfigurator;

return function (ContainerConfiguratorInterface $containerConfigurator) {
    $containerConfigurator->singleton(EventDispatcherConfiguratorInterface::class, EventDispatcherConfigurator::class);
    $containerConfigurator->singleton(EventDispatcherInterface::class, EventDispatcher::class);
    $containerConfigurator->singleton(\Symfony\Component\EventDispatcher\EventDispatcherInterface::class, EventDispatcher::class);
    $containerConfigurator->singleton(\Psr\EventDispatcher\EventDispatcherInterface::class, EventDispatcherInterface::class);
};
