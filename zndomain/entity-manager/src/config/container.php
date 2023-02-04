<?php

use Psr\Container\ContainerInterface;
use Untek\Core\Container\Interfaces\ContainerConfiguratorInterface;
use Untek\Domain\EntityManager\Interfaces\EntityManagerConfiguratorInterface;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\EntityManager\Libs\EntityManager;
use Untek\Domain\EntityManager\Libs\EntityManagerConfigurator;

return function (ContainerConfiguratorInterface $containerConfigurator) {
    $containerConfigurator->singleton(EntityManagerInterface::class, function (ContainerInterface $container) {
        $em = EntityManager::getInstance($container);
//            $eloquentOrm = $container->get(EloquentOrm::class);
//            $em->addOrm($eloquentOrm);
        return $em;
    });

    $containerConfigurator->singleton(EntityManagerConfiguratorInterface::class, EntityManagerConfigurator::class);
};
