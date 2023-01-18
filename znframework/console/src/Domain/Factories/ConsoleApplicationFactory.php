<?php

namespace ZnFramework\Console\Domain\Factories;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\HttpFoundation\Request;
use ZnCore\App\Interfaces\AppInterface;
use ZnCore\Container\Interfaces\ContainerConfiguratorInterface;
use ZnCore\DotEnv\Domain\Libs\DotEnvLoader;
use ZnCore\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use ZnFramework\Console\Domain\Libs\ConsoleApp;

class ConsoleApplicationFactory extends BaseConsoleApplicationFactory
{

    public function __construct(protected ContainerInterface $container)
    {
    }

    protected function initApp(): void
    {
        $consoleAppClass = $this->getConsoleAppClass();
        $this->getContainerConfigurator()->singleton(AppInterface::class, $consoleAppClass);
        $this->getApp()->init();
    }
    
    public function createApplicationInstance(): Application
    {
        $this->initApp();
        return $this->getConsoleApplicationInstance();
    }
    
    protected function getConsoleAppClass(): string {
        if (isset($_ENV['CONSOLE_APP_CLASS'])) {
            $consoleAppClass = $_ENV['CONSOLE_APP_CLASS'];
        } else {
            $loader = new DotEnvLoader();
            $mainEnv = $loader->loadFromFile(__DIR__ . '/../../../../../../../../.env');
            $consoleAppClass = $mainEnv['CONSOLE_APP_CLASS'] ?? ConsoleApp::class;
        }
        return $consoleAppClass;
    }
}
