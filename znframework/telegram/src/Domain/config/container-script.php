<?php

use Psr\Container\ContainerInterface;
use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\ConfigManager\Interfaces\ConfigManagerInterface;
use ZnCore\Env\Helpers\EnvHelper;
use ZnFramework\Telegram\Domain\Interfaces\Repositories\ResponseRepositoryInterface;
use ZnFramework\Telegram\Domain\Repositories\File\ConfigRepository;
use ZnFramework\Telegram\Domain\Repositories\Telegram\ResponseRepository as TelegramResponseRepository;
use ZnFramework\Telegram\Domain\Repositories\Test\ResponseRepository as TestResponseRepository;
use ZnFramework\Telegram\Domain\Services\RouteService;

return [
    'singletons' => [
        RouteService::class => function (ContainerInterface $container) {
            /** @var ConfigManagerInterface $configManager */
            $configManager = $container->get(ConfigManagerInterface::class);
            $telegramRoutes = $configManager->get('telegramRoutes', []);
            $routeService = new RouteService();
            $routes = [];
            foreach ($telegramRoutes as $containerConfig) {
                $requiredConfig = require($containerConfig);
                $routes = ArrayHelper::merge($routes, $requiredConfig);
            }
            $routeService->setDefinitions($routes);
            return $routeService;
        },
        ResponseRepositoryInterface::class =>
            EnvHelper::isTest() ?
                TestResponseRepository::class :
                TelegramResponseRepository::class,
        ConfigRepository::class => function (ContainerInterface $container) {
            /** @var \ZnCore\App\Interfaces\EnvStorageInterface $envStorage */
            $envStorage = $container->get(\ZnCore\App\Interfaces\EnvStorageInterface::class);

            $repo = new ConfigRepository($envStorage->get('TELEGRAM_BOT_TOKEN') ?: null);
            return $repo;
        },
    ],
];
