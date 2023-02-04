<?php

use Untek\Bundle\Dashboard\Domain\Services\DashboardService;
use Psr\Container\ContainerInterface;

return [
    'singletons' => [
        'Untek\Bundle\Dashboard\Domain\Interfaces\Services\DocServiceInterface' => 'Untek\Bundle\Dashboard\Domain\Services\DocService',
//        'Untek\\Bundle\\Dashboard\\Domain\\Interfaces\\Services\\DashboardServiceInterface' => function (ContainerInterface $container) {
//            /** @var DashboardService $service */
//            $service = $container->get(DashboardService::class);
//            $config = include __DIR__ . '/../../../../frontend/config/extra/dashboard.php';
//            $service->setConfig($config);
//            return $service;
//        },
    ],
];