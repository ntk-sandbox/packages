<?php

namespace Untek\Framework\Console\Symfony4\Libs;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Untek\Core\Code\Helpers\ComposerHelper;
use Untek\Core\FileSystem\Helpers\FindFileHelper;

class CommandConfigurator
{

    public function __construct(protected ContainerInterface $container, protected Application $application, protected LoggerInterface $logger)
    {
    }

    public function registerFromNamespaceList(array $namespaceList): void
    {
        foreach ($namespaceList as $namespace) {
            $this->registerFromNamespace($namespace);
        }
    }

    protected function registerFromNamespace(string $namespace): void
    {
//        dump($namespace);
        $files = $this->scanByNamespace($namespace);
//        dump($namespace, $files);
        $commands = $this->forgeFullClassNames($files, $namespace);
//        dump($commands);
        foreach ($commands as $commandClassName) {
            $this->registerCommandClass($commandClassName);
        }
    }

    public function registerCommandInstance(Command $commandInstance): void
    {
        $this->application->add($commandInstance);
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
//                echo $message . PHP_EOL;
                $this->logger->warning($message);
            }
        }
    }

    protected function scanByNamespace(string $namespace): array
    {
        $path = ComposerHelper::getPsr4Path($namespace);
//        dump($namespace, $path);
        $files = FindFileHelper::scanDir($path);
        $files = array_filter(
            $files,
            function ($value) {
                return preg_match('/\.php$/i', $value);
            }
        );
        return $files;
    }

    protected function forgeFullClassNames(array $files, string $namespace): array
    {
        $commands = array_map(
            function ($classNameWithExt) use ($namespace) {
                $className = str_replace('.php', '', $classNameWithExt);
                return $namespace . '\\' . $className;
            },
            $files
        );
        return $commands;
    }
}
