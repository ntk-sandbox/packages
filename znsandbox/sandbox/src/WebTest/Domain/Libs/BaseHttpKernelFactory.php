<?php

namespace ZnSandbox\Sandbox\WebTest\Domain\Libs;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use ZnCore\App\Interfaces\AppInterface;
use ZnCore\Container\Interfaces\ContainerConfiguratorInterface;
use ZnCore\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;

abstract class BaseHttpKernelFactory
{

    public function __construct(protected ContainerInterface $container)
    {
    }

    abstract protected function initApp(Request $request): void;

    public function createKernelInstance(Request $request): HttpKernelInterface|TerminableInterface
    {
        $this->forgeServerVar($request);
        $this->initApp($request);
        return $this->getKernel();
    }

    protected function forgeServerVar(Request $request): void
    {
        foreach ($request->server->all() as $key => $value) {
            $_SERVER[$key] = $value;
        }
    }

    protected function getKernel(): HttpKernelInterface|TerminableInterface
    {
        /** @var HttpKernelInterface $framework */
        $framework = $this->container->get(HttpKernelInterface::class);
        return $framework;
    }

    protected function getApp(): AppInterface
    {
        /** @var AppInterface $app */
        $app = $this->container->get(AppInterface::class);
        return $app;
    }

    protected function getEventDispatcherConfigurator(): EventDispatcherConfiguratorInterface
    {
        /** @var EventDispatcherConfiguratorInterface $eventDispatcherConfigurator */
        $eventDispatcherConfigurator = $this->container->get(EventDispatcherConfiguratorInterface::class);
        return $eventDispatcherConfigurator;
    }

    protected function getContainerConfigurator(): ContainerConfiguratorInterface
    {
        /** @var ContainerConfiguratorInterface $containerConfigurator */
        $containerConfigurator = $this->container->get(ContainerConfiguratorInterface::class);
        return $containerConfigurator;
    }
}
