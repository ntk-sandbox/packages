<?php

namespace ZnFramework\Console\Symfony4\Libs;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Application;
use ZnCore\Code\Helpers\ComposerHelper;
use ZnCore\FileSystem\Helpers\FindFileHelper;

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
        $files = $this->scanByNamespace($namespace);
        $commands = $this->forgeFullClassNames($files, $namespace);
        foreach ($commands as $commandClassName) {
            $this->addCommand($commandClassName);
        }
    }

    protected function addCommand(string $commandClassName): void
    {
        $reflictionClass = new \ReflectionClass($commandClassName);
        if (!$reflictionClass->isAbstract()) {
            try {
                $commandInstance = $this->container->get($commandClassName);
                $this->application->add($commandInstance);
            } catch (\Illuminate\Contracts\Container\BindingResolutionException | \Illuminate\Container\EntryNotFoundException $e) {
                $message = "DI dependencies not resolved for class \"$commandClassName\"!";
//                echo $message . PHP_EOL;
                $this->logger->warning($message);
            }
        }
    }

    protected function scanByNamespace(string $namespace): array
    {
        $path = ComposerHelper::getPsr4Path($namespace);
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
