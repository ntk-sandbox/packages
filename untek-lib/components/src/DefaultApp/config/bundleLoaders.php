<?php

use Untek\Core\Container\Libs\BundleLoaders\ContainerLoader;
use Untek\Database\Migration\Domain\Libs\BundleLoaders\MigrationLoader;
use Untek\Model\EntityManager\Libs\BundleLoaders\EntityManagerLoader;
use Untek\Lib\Components\Cors\Libs\BundleLoaders\EventDispatcherLoader;
use Untek\Component\I18Next\Libs\BundleLoaders\I18NextLoader;
use Untek\User\Rbac\Domain\Libs\BundleLoaders\RbacConfigLoader;

return [
    'entityManager' => EntityManagerLoader::class,
    'eventDispatcher' => EventDispatcherLoader::class,
    'container' => ContainerLoader::class,
    'i18next' => I18NextLoader::class,
    'rbac' => RbacConfigLoader::class,
    'migration' => MigrationLoader::class,
];
