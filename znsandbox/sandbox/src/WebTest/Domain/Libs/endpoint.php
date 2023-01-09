<?php

/**
 * @var ContainerInterface $container
 * @var Request $request
 */

\ZnCore\Code\Helpers\DeprecateHelper::hardThrow();

use App\Application\Admin\Libs\AdminApp;
use App\Application\Rpc\Libs\RpcApp;
use App\Application\Web\Libs\WebApp;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use ZnCore\App\Interfaces\AppInterface;
use ZnCore\App\Libs\EnvServer;
use ZnCore\App\Libs\ZnCore;
use ZnCore\Container\Interfaces\ContainerConfiguratorInterface;
use ZnCore\Container\Libs\Container;
use ZnCore\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use ZnTool\Dev\VarDumper\Subscribers\SymfonyDumperSubscriber;

$_SERVER['MICRO_TIME'] = microtime(true);

//require __DIR__ . '/../vendor/autoload.php';

/**
 * Инициализация ядра.
 *
 * Инициализируются/конфигурируются компоненты:
 * - DotEnv
 * - контейнер
 *   - EventDispatcher
 *   - ConfigManager
 *   - ContainerConfigurator
 * - загрузчик бандлов
 */
//$container = new Container();
//$znCore = new ZnCore($container);
//$znCore->init();

//\ZnCore\Env\Helpers\EnvHelper::setErrorVisibleFromEnv();

/** @var ContainerConfiguratorInterface $containerConfigurator */
$containerConfigurator = $container->get(ContainerConfiguratorInterface::class);

$envServer = new EnvServer($request->server->all());
if ($envServer->isContainsSegmentUri('admin')) {
    $envServer->fixUri('admin');
    $containerConfigurator->singleton(AppInterface::class, AdminApp::class);
//} elseif ($envServer->isContainsSegmentUri('wsdl')) {
//    $containerConfigurator->singleton(AppInterface::class, WsdlApp::class);
} elseif ($envServer->isEqualUri('json-rpc') && ($envServer->isPostMethod() || $envServer->isOptionsMethod())) {
    $containerConfigurator->singleton(AppInterface::class, RpcApp::class);
} else {
    $containerConfigurator->singleton(AppInterface::class, WebApp::class);
}

/**
 * Инициализация приложения.
 *
 * Инициализируются/конфигурируются компоненты:
 * - dotEnv
 * - контейнер
 * - бандлы
 * - диспетчер событий: подписка на события приложения
 * - Cors (для приложения RPC)
 * - команды консоли
 * - поведения
 *   - layout
 *   - обработчик ошибок
 */

/** @var EventDispatcherConfiguratorInterface $eventDispatcherConfigurator */
$eventDispatcherConfigurator = $container->get(EventDispatcherConfiguratorInterface::class);

/** Подключаем дампер */
$eventDispatcherConfigurator->addSubscriber(SymfonyDumperSubscriber::class);

/** @var AppInterface $appFactory */
$appFactory = $container->get(AppInterface::class);
$appFactory->init();
