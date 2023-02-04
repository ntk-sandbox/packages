<?php

use Psr\Container\ContainerInterface;
use Symfony\Component\Lock\LockFactory;
use Symfony\Component\Lock\Store\FlockStore;
use Symfony\Component\Lock\Store\PostgreSqlStore;
use Symfony\Component\Lock\Store\SemaphoreStore;
use Untek\Database\Base\Domain\Enums\DbDriverEnum;
use Untek\Database\Eloquent\Domain\Capsule\Manager;

return [
    'definitions' => [],
    'singletons' => [
        LockFactory::class => function (ContainerInterface $container) {
            /** @var Manager $capsule */
            $capsule = $container->get(Manager::class);
            $driverConnection = $capsule->getConnection()->getPdo();
            $driverName = $capsule->getConnection()->getDriverName();
            if ($driverName == DbDriverEnum::PGSQL) {
                $store = new PostgreSqlStore($driverConnection);
            } else {
                $isSupportedSemaphoreStore = class_exists(SemaphoreStore::class) && SemaphoreStore::isSupported();
                if ($isSupportedSemaphoreStore) {
                    $store = new SemaphoreStore();
                } else {
                    $store = new FlockStore();
                }
            }
            return new LockFactory($store);
        },
    ],
];
