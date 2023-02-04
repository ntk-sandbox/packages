<?php

namespace Untek\Framework\Console\Domain\Factories;

use Symfony\Component\Console\Application;
use Untek\Core\App\Interfaces\AppInterface;
use Untek\Core\Container\Interfaces\ContainerConfiguratorInterface;
use Untek\Core\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;

abstract class BaseConsoleApplicationFactory
{

    protected function getConsoleApplicationInstance(): Application
    {
        /** @var Application $application */
        $application = $this->container->get(Application::class);
        return $application;
    }

    protected function getApp(): AppInterface
    {
        /** @var AppInterface $app */
        $app = $this->container->get(AppInterface::class);
        return $app;
    }

    protected function getEventDispatcherConfigurator(): EventDispatcherConfiguratorInterface
    {
        /** @var EventDispatcherConfiguratorInterface $eventDispatcherConfigurator */
        $eventDispatcherConfigurator = $this->container->get(EventDispatcherConfiguratorInterface::class);
        return $eventDispatcherConfigurator;
    }

    protected function getContainerConfigurator(): ContainerConfiguratorInterface
    {
        /** @var ContainerConfiguratorInterface $containerConfigurator */
        $containerConfigurator = $this->container->get(ContainerConfiguratorInterface::class);
        return $containerConfigurator;
    }
}
