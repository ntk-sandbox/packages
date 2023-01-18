<?php

namespace ZnFramework\Console\Domain\Factories;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use ZnCore\App\Interfaces\AppInterface;
use ZnCore\Container\Interfaces\ContainerConfiguratorInterface;
use ZnCore\DotEnv\Domain\Libs\DotEnvLoader;
use ZnCore\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use ZnFramework\Console\Domain\Libs\ConsoleApp;

abstract class BaseConsoleApplicationFactory
{

    protected function getConsoleApplicationInstance(): Application {
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
