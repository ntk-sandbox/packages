<?php

namespace Untek\Framework\Console\Symfony4\Libs;

use Psr\Container\ContainerExceptionInterface;
use Symfony\Component\Console\Command\Command;
use Untek\Framework\Console\Symfony4\Helpers\CommandConfiguratorHelper;
use Untek\Framework\Console\Symfony4\Interfaces\CommandConfiguratorInterface;

abstract class BaseCommandConfigurator implements CommandConfiguratorInterface
{

    abstract public function registerCommandInstance(Command $commandInstance): void;

    public function registerFromNamespaceList(array $namespaceList): void
    {
        foreach ($namespaceList as $namespace) {
            $this->registerFromNamespace($namespace);
        }
    }

    public function registerCommandClass(string $commandClassName): void
    {
        $reflictionClass = new \ReflectionClass($commandClassName);
        if (!$reflictionClass->isAbstract()) {
            try {
                $commandInstance = $this->container->get($commandClassName);
                $this->registerCommandInstance($commandInstance);
            } catch (ContainerExceptionInterface $e) {
                $message = "DI dependencies not resolved for class \"$commandClassName\"!";
                $this->logger?->warning($message);
            }
        }
    }

    protected function registerFromNamespace(string $namespace): void
    {
        $commands = CommandConfiguratorHelper::scanCommandsByNamespace($namespace);
        foreach ($commands as $commandClassName) {
            $this->registerCommandClass($commandClassName);
        }
    }
}
