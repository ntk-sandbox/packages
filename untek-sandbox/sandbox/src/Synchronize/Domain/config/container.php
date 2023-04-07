<?php

use Psr\Container\ContainerInterface;
use Untek\Core\DotEnv\Domain\Libs\DotEnv;
use Untek\Component\FormatAdapter\StoreFile;
use Untek\Sandbox\Sandbox\Synchronize\Domain\Interfaces\Services\SynchronizeServiceInterface;
use Untek\Sandbox\Sandbox\Synchronize\Domain\Services\SynchronizeService;

return [
    'singletons' => [
//		'Untek\\Sandbox\\Sandbox\\Synchronize\\Domain\\Interfaces\\Services\\SynchronizeServiceInterface' => 'Untek\\Sandbox\\Sandbox\\Synchronize\\Domain\\Services\\SynchronizeService',
        SynchronizeServiceInterface::class => function (ContainerInterface $container) {
            /** @var \Untek\Core\App\Interfaces\EnvStorageInterface $envStorage */
            $envStorage = $container->get(\Untek\Core\App\Interfaces\EnvStorageInterface::class);

            /** @var SynchronizeService $service */
            $service = $container->get(SynchronizeService::class);
            $configFile = $envStorage->get('SYNCHRONIZE_CONFIG_FILE');
//            dd($configFile);

            $store = new StoreFile($configFile);

            $config = $store->load();
            $service->setConfig($config);
            return $service;
        },
    ],
];