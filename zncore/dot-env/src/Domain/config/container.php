<?php

use Psr\Container\ContainerInterface;
use Symfony\Component\Dotenv\Command\DebugCommand;
use Symfony\Component\Dotenv\Command\DotenvDumpCommand;
use ZnCore\Env\Helpers\EnvHelper;
use ZnCore\FileSystem\Helpers\FilePathHelper;

return [
    'definitions' => [
        DotenvDumpCommand::class => function (ContainerInterface $container) {
            /** @var \ZnCore\App\Interfaces\EnvStorageInterface $envStorage */
            $envStorage = $container->get(\ZnCore\App\Interfaces\EnvStorageInterface::class);

            $env = $envStorage->get('APP_ENV');
            $path = FilePathHelper::rootPath();

            return new DotenvDumpCommand($path, $env);
        },
        DebugCommand::class => function (ContainerInterface $container) {
            /** @var \ZnCore\App\Interfaces\EnvStorageInterface $envStorage */
            $envStorage = $container->get(\ZnCore\App\Interfaces\EnvStorageInterface::class);

            $env = $envStorage->get('APP_ENV');
            $path = FilePathHelper::rootPath();

            return new DebugCommand($env, $path);
        },
    ],
];
