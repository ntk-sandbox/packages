<?php

namespace Untek\Framework\Console\Symfony4\Base;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Untek\Core\App\Base\BaseApp;
use Untek\Core\App\Libs\ZnCore;
use Untek\Core\App\Subscribers\PhpErrorSubscriber;
use Untek\Core\Bundle\Base\CallMethodLoader;
use Untek\Core\Bundle\Libs\BundleLoader;
use Untek\Core\ConfigManager\Interfaces\ConfigManagerInterface;
use Untek\Core\Container\Interfaces\ContainerConfiguratorInterface;
use Untek\Core\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use Untek\Framework\Console\Domain\Libs\BundleLoaders\ConsoleLoader;
use Untek\Framework\Console\Domain\Subscribers\ConsoleDetectTestEnvSubscriber;
use Untek\Framework\Console\Symfony4\Libs\CommandConfigurator;

abstract class BaseConsoleApp extends BaseApp
{

    private $configManager;

    public function __construct(
        ContainerInterface $container,
        EventDispatcherInterface $dispatcher,
        ZnCore $znCore,
        ContainerConfiguratorInterface $containerConfigurator,
        ConfigManagerInterface $configManager
    ) {
        parent::__construct($container, $dispatcher, $znCore, $containerConfigurator);
        $this->configManager = $configManager;
    }

    public function appName(): string
    {
        return 'console';
    }

    public function subscribes(): array
    {
        return [
            ConsoleDetectTestEnvSubscriber::class,
            PhpErrorSubscriber::class,
        ];
    }

    public function import(): array
    {
        return [
            'i18next',
            'container',
            'entityManager',
            'eventDispatcher',
            'rbac',
            'console',
//            'consoleCommands',
            'migration',
            'symfonyRpc',
            'telegramRoutes'
        ];
    }

    protected function bundleLoaders(): array
    {
        $loaders = parent::bundleLoaders();
        $loaders['console'] = ConsoleLoader::class;
//        $loaders['consoleCommands'] = CallMethodLoader::class;
        return $loaders;
    }

    public function init(): void
    {
        parent::init();
        $consoleCommands = $this->configManager->get('consoleCommands');
        $this->createConsole($consoleCommands);
    }

    protected function configContainer(ContainerConfiguratorInterface $containerConfigurator): void
    {
        $containerConfigurator->singleton(Application::class, Application::class);
    }

    protected function configDispatcher(EventDispatcherConfiguratorInterface $configurator): void
    {
    }

    protected function createConsole(array $consoleCommands)
    {
        /** @var Application $application */
        $application = $this->getContainer()->get(Application::class);
        $application->getDefinition()->addOptions(
            [
                new InputOption(
                    '--env',
                    '-e',
                    InputOption::VALUE_OPTIONAL,
                    'The environment to operate in.',
                    'DEV'
                )
            ]
        );

        /** @var CommandConfigurator $commandConfigurator */
        $commandConfigurator = $this->getContainer()->get(CommandConfigurator::class);
        $bundleLoader = $this->getContainer()->get(BundleLoader::class);
        $bundleLoader->callMethod('consoleCommands', CallMethodLoader::class);

        if (!empty($consoleCommands)) {
            $commandConfigurator->registerFromNamespaceList($consoleCommands);
        }
    }
}
