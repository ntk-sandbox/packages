<?php

namespace ZnSandbox\Sandbox\WebTest\Domain\Libs;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use ZnCore\App\Interfaces\AppInterface;
use ZnCore\App\Libs\EnvServer;
use ZnCore\Container\Interfaces\ContainerConfiguratorInterface;
use ZnCore\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use ZnTool\Dev\VarDumper\Subscribers\SymfonyDumperSubscriber;

abstract class BaseHttpKernelFactory
{

    public function __construct(private ContainerInterface $container)
    {
    }

    abstract protected function apps(): array;

    public function createKernelInstance(Request $request): HttpKernelInterface|TerminableInterface
    {
        $this->forgeServerVar($request);
        $this->bindApp($request);
        $this->registerSubscribers();

        /** @var AppInterface $app */
        $app = $this->container->get(AppInterface::class);
        $app->init();

        $framework = $this->container->get(HttpKernelInterface::class);
        return $framework;
    }

    protected function forgeServerVar(Request $request): void
    {
        foreach ($request->server->all() as $key => $value) {
            $_SERVER[$key] = $value;
        }
    }

    protected function registerSubscribers()
    {
        /** @var EventDispatcherConfiguratorInterface $eventDispatcherConfigurator */
        $eventDispatcherConfigurator = $this->container->get(EventDispatcherConfiguratorInterface::class);

        /** Подключаем дампер */
        $eventDispatcherConfigurator->addSubscriber(SymfonyDumperSubscriber::class);
    }

    protected function bindApp(Request $request)
    {
        $apps = $this->apps();
        /** @var ContainerConfiguratorInterface $containerConfigurator */
        $containerConfigurator = $this->container->get(ContainerConfiguratorInterface::class);

        $envServer = new EnvServer($request->server->all());
        if ($envServer->isContainsSegmentUri('admin')) {
            $envServer->fixUri('admin');
            $containerConfigurator->singleton(AppInterface::class, $apps['admin']);
            //} elseif ($envServer->isContainsSegmentUri('wsdl')) {
            //    $containerConfigurator->singleton(AppInterface::class, WsdlApp::class);
        } elseif ($envServer->isEqualUri('json-rpc') && ($envServer->isPostMethod() || $envServer->isOptionsMethod())) {
            $containerConfigurator->singleton(AppInterface::class, $apps['json-rpc']);
        } else {
            $containerConfigurator->singleton(AppInterface::class, $apps['web']);
        }
    }
}
