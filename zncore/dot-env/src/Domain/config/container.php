<?php

use Psr\Container\ContainerInterface;
use Symfony\Component\Dotenv\Command\DebugCommand;
use Symfony\Component\Dotenv\Command\DotenvDumpCommand;
use ZnCore\Env\Helpers\EnvHelper;
use ZnCore\FileSystem\Helpers\FilePathHelper;

return [
    'definitions' => [
        DotenvDumpCommand::class => function () {
            $env = getenv('APP_ENV');
            $path = FilePathHelper::rootPath();

            return new DotenvDumpCommand($path, $env);
        },
        DebugCommand::class => function (ContainerInterface $container) {
            $env = getenv('APP_ENV');
            $path = FilePathHelper::rootPath();

            return new DebugCommand($env, $path);
        },
    ],
];
