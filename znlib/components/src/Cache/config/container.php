<?php

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Untek\Core\Env\Helpers\EnvHelper;
use Untek\Lib\Components\Time\Enums\TimeEnum;

return [
    'singletons' => [
        AdapterInterface::class => function (ContainerInterface $container) {
            /** @var \Untek\Core\App\Interfaces\EnvStorageInterface $envStorage */
            $envStorage = $container->get(\Untek\Core\App\Interfaces\EnvStorageInterface::class);

            $isEnableCache = EnvHelper::isProd();
            if ($isEnableCache) {
                $cacheDirectory = $envStorage->get('CACHE_DIRECTORY');
                $adapter = new FilesystemAdapter('app', TimeEnum::SECOND_PER_DAY, $cacheDirectory);
                $adapter->setLogger($container->get(LoggerInterface::class));
            } else {
                $adapter = new ArrayAdapter();
            }
            return $adapter;
        },
    ],
];
