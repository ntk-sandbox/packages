<?php

use ZnCore\Container\Libs\BundleLoaders\ContainerLoader;
use ZnDatabase\Migration\Domain\Libs\BundleLoaders\MigrationLoader;
use ZnDomain\EntityManager\Libs\BundleLoaders\EntityManagerLoader;
use ZnLib\Components\Cors\Libs\BundleLoaders\EventDispatcherLoader;
use ZnLib\I18Next\Libs\BundleLoaders\I18NextLoader;
use ZnUser\Rbac\Domain\Libs\BundleLoaders\RbacConfigLoader;

return [
    'entityManager' => EntityManagerLoader::class,
    'eventDispatcher' => EventDispatcherLoader::class,
    'container' => ContainerLoader::class,
    'i18next' => I18NextLoader::class,
    'rbac' => RbacConfigLoader::class,
    'migration' => MigrationLoader::class,
];
