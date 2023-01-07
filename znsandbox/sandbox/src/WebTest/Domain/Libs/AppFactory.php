<?php

namespace ZnSandbox\Sandbox\WebTest\Domain\Libs;

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


abstract class AppFactory
{
    
    public function __construct(private ContainerInterface $container)
    {
    }

    abstract protected function apps(): array;
    
    public function createKernelInstance(Request $request): HttpKernelInterface
    {
        $this->forgeServerVar($request);
        $app = $this->createAppInstance($request);
        $app->init();
        
        $framework = $this->container->get(HttpKernelInterface::class);
        return $framework;
    }

    protected function forgeServerVar(Request $request): void {
        foreach ($request->server->all() as $key => $value) {
            $_SERVER[$key] = $value;
        }
    }
    
    public function createAppInstance(Request $request): AppInterface
    {
        $this->assignApp($this->container, $request, $this->apps());

        /** @var EventDispatcherConfiguratorInterface $eventDispatcherConfigurator */
        $eventDispatcherConfigurator = $this->container->get(EventDispatcherConfiguratorInterface::class);

        /** Подключаем дампер */
        $eventDispatcherConfigurator->addSubscriber(SymfonyDumperSubscriber::class);

        /** @var AppInterface $appFactory */
        $appFactory = $this->container->get(AppInterface::class);
        
        return $appFactory;
    }

    public function assignApp(ContainerInterface $container, Request $request, array $apps)
    {
        /** @var ContainerConfiguratorInterface $containerConfigurator */
        $containerConfigurator = $container->get(ContainerConfiguratorInterface::class);

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
