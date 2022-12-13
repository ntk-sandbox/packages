<?php

namespace ZnLib\Socket\Domain\Apps\Base;

use Psr\Container\ContainerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use ZnCore\App\Base\BaseApp;
use ZnCore\App\Libs\ZnCore;
use ZnCore\Code\Helpers\DeprecateHelper;
use ZnCore\ConfigManager\Interfaces\ConfigManagerInterface;
use ZnCore\Container\Interfaces\ContainerConfiguratorInterface;
use ZnFramework\Console\Domain\Subscribers\ConsoleDetectTestEnvSubscriber;
use ZnLib\Socket\Domain\Libs\SocketDaemon;

//DeprecateHelper::hardThrow();

abstract class BaseWebSocketApp extends BaseApp
{

    private $configManager;

    public function __construct(
        ContainerInterface $container,
        EventDispatcherInterface $dispatcher,
        ZnCore $znCore,
        ContainerConfiguratorInterface $containerConfigurator,
        ConfigManagerInterface $configManager
    )
    {
        parent::__construct($container, $dispatcher, $znCore, $containerConfigurator);
        $this->configManager = $configManager;
    }

    public function appName(): string
    {
        return 'webSocket';
    }

    public function subscribes(): array
    {
        return [
            ConsoleDetectTestEnvSubscriber::class,
        ];
    }

    public function import(): array
    {
        return ['i18next', 'container', 'entityManager', 'eventDispatcher', 'console', 'migration', 'rbac', 'symfonyRpc', 'telegramRoutes'];
    }

    protected function configContainer(ContainerConfiguratorInterface $containerConfigurator): void
    {
        $containerConfigurator->singleton(SocketDaemon::class, SocketDaemon::class);
    }
}
