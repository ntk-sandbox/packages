<?php

namespace ZnTool\Test\Factories;

use Psr\Container\ContainerInterface;
use ZnCore\Code\Helpers\DeprecateHelper;
use ZnCore\Container\Libs\Container;
use ZnCore\Container\Helpers\ContainerHelper;
use ZnCore\Container\Interfaces\ContainerConfiguratorInterface;
use ZnCore\App\Interfaces\AppInterface;
use ZnCore\App\Libs\ZnCore;
use ZnTool\Test\Libs\TestApp;

DeprecateHelper::hardThrow();

class TestAppFactory
{

    public static function createInstance(ContainerInterface $container): AppInterface
    {
//        $container = ContainerHelper::getContainer() ?: new Container();
        $znCore = new ZnCore($container);
        $znCore->init();

        /** @var ContainerConfiguratorInterface $containerConfigurator */
        $containerConfigurator = $container->get(ContainerConfiguratorInterface::class);
        $containerConfigurator->singleton(AppInterface::class, TestApp::class);

        /** @var AppInterface $appFactory */
        $appFactory = $container->get(AppInterface::class);
        return $appFactory;
    }
}
