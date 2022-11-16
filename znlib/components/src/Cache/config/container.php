<?php

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use ZnCore\DotEnv\Domain\Libs\DotEnv;
use ZnCore\Env\Helpers\EnvHelper;
use ZnLib\Components\Time\Enums\TimeEnum;

return [
    'singletons' => [
        AdapterInterface::class => function (ContainerInterface $container) {
            $isEnableCache = EnvHelper::isProd();
            if ($isEnableCache) {
                $cacheDirectory = DotEnv::get('CACHE_DIRECTORY');
                $adapter = new FilesystemAdapter('app', TimeEnum::SECOND_PER_DAY, $cacheDirectory);
                $adapter->setLogger($container->get(LoggerInterface::class));
            } else {
                $adapter = new ArrayAdapter();
            }
            return $adapter;
        },
    ],
];
