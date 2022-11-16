<?php

namespace ZnFramework\Telegram\Domain\Facades;

use ZnCore\Container\Interfaces\ContainerConfiguratorInterface;
use ZnCore\Container\Libs\Container;
use ZnCore\Container\Helpers\ContainerHelper;
use ZnFramework\Telegram\Domain\Interfaces\Repositories\ResponseRepositoryInterface;
use ZnFramework\Telegram\Domain\Repositories\Telegram\ResponseRepository;
use ZnFramework\Telegram\Domain\Services\BotService;
use ZnFramework\Telegram\Domain\Services\RequestService;
use ZnFramework\Telegram\Domain\Services\ResponseService;

class BotFacade
{

    public static function getResponseService(string $token): ResponseService
    {
        /** @var Container $container */
        $container = ContainerHelper::getContainer();

        /** @var ContainerConfiguratorInterface $containerConfigurator */
        $containerConfigurator = $container->get(ContainerConfiguratorInterface::class);
//        $containerConfigurator = ContainerHelper::getContainerConfiguratorByContainer($container);
        $containerConfigurator->singleton(ResponseRepositoryInterface::class, ResponseRepository::class);
        $containerConfigurator->singleton(BotService::class, BotService::class);

//        $container->singleton(ResponseRepositoryInterface::class, ResponseRepository::class);
//        $container->singleton(BotService::class, BotService::class);
        $botService = $container->get(BotService::class);
        $botService->authByToken($token);
        /** @var RequestService $requestService */
//        $requestService = $container->get(RequestService::class);
        /** @var ResponseService $responseService */
        $responseService = $container->get(ResponseService::class);
        return $responseService;
    }
}
