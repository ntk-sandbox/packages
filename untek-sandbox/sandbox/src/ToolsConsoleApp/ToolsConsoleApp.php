<?php

namespace Untek\Sandbox\Sandbox\ToolsConsoleApp;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Untek\Core\App\Interfaces\EnvironmentInterface;
use Untek\Core\App\Libs\DefaultEnvironment;
use Untek\Core\Container\Interfaces\ContainerConfiguratorInterface;
use Untek\Core\DotEnv\Domain\Interfaces\BootstrapInterface;
use Untek\Core\DotEnv\Domain\Libs\Vlucas\VlucasBootstrap;
use Untek\Framework\Console\Symfony4\Base\BaseConsoleApp;

class ToolsConsoleApp extends BaseConsoleApp
{

    protected function configContainer(ContainerConfiguratorInterface $containerConfigurator): void
    {
        $containerConfigurator->singleton(EnvironmentInterface::class, DefaultEnvironment::class);
        $containerConfigurator->singleton(BootstrapInterface::class, VlucasBootstrap::class);
        $containerConfigurator->bind(LoggerInterface::class, NullLogger::class);
        parent::configContainer($containerConfigurator);
    }

    protected function bundles(): array
    {
        return [
            new \Untek\Tool\Package\Bundle(['all']),
            new \Untek\Lib\Init\Bundle(['all']),
        ];
    }
}
