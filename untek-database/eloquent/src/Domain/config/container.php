<?php

use Psr\Container\ContainerInterface;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\EntityManager\Libs\EntityManager;
use Untek\Database\Eloquent\Domain\Capsule\Manager;
use Untek\Database\Eloquent\Domain\Factories\ManagerFactory;
use Illuminate\Database\Capsule\Manager as CapsuleManager;

return [
    'definitions' => [],
    'singletons' => [
        /*EntityManagerInterface::class => EntityManager::class,
        EntityManager::class => function (ContainerInterface $container) {
            return EntityManager::getInstance($container);
        },*/
        /*EntityManagerInterface::class => function (ContainerInterface $container) {
            $em = EntityManager::getInstance($container);
//            $eloquentOrm = $container->get(EloquentOrm::class);
//            $em->addOrm($eloquentOrm);
            return $em;
        },*/
        Manager::class => function () {
            return ManagerFactory::createManagerFromEnv();
        },
        CapsuleManager::class => Manager::class,
    ],
];
