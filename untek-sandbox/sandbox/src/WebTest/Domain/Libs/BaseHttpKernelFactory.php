<?php

namespace Untek\Sandbox\Sandbox\WebTest\Domain\Libs;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use Untek\Core\App\Interfaces\AppInterface;
use Untek\Core\Container\Interfaces\ContainerConfiguratorInterface;
use Untek\Core\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use Untek\Lib\Components\Http\Helpers\SymfonyHttpResponseHelper;

abstract class BaseHttpKernelFactory
{

    public function __construct(protected ContainerInterface $container)
    {
    }

    abstract protected function initApp(Request $request): void;

    public function createKernelInstance(Request $request): HttpKernelInterface|TerminableInterface
    {
        SymfonyHttpResponseHelper::forgeServerVar($request);
        $this->initApp($request);
        return $this->getKernelInstance();
    }

    protected function getKernelInstance(): HttpKernelInterface|TerminableInterface
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
