<?php

use Psr\Container\ContainerInterface;
use Symfony\Component\Dotenv\Command\DebugCommand;
use Symfony\Component\Dotenv\Command\DotenvDumpCommand;
use ZnCore\Env\Helpers\EnvHelper;
use ZnCore\FileSystem\Helpers\FilePathHelper;

return [
    'definitions' => [
        DotenvDumpCommand::class => function () {
            $env = EnvHelper::getAppEnv();
            $path = FilePathHelper::rootPath();

            return new DotenvDumpCommand($path, $env);
        },
        DebugCommand::class => function (ContainerInterface $container) {
            $env = EnvHelper::getAppEnv();
            $path = FilePathHelper::rootPath();

            return new DebugCommand($env, $path);
        },
    ],
];
