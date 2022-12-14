<?php

namespace ZnLib\Web\RestApiApp\Base;

use Symfony\Component\ErrorHandler\ErrorRenderer\ErrorRendererInterface;
use Symfony\Component\ErrorHandler\ErrorRenderer\HtmlErrorRenderer;
use Symfony\Component\ErrorHandler\ErrorRenderer\SerializerErrorRenderer;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Matcher\RequestMatcherInterface;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\Routing\RouteCollection;
use ZnCore\App\Base\BaseApp;
use ZnCore\Container\Interfaces\ContainerConfiguratorInterface;
use ZnCore\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use ZnLib\Web\View\Libs\View;
use ZnLib\Web\WebApp\Subscribers\FindRouteSubscriber;
use ZnLib\Web\WebApp\Subscribers\WebDetectTestEnvSubscriber;
use ZnLib\Web\WebApp\Subscribers\WebFirewallSubscriber;

abstract class BaseRestApiApp extends BaseApp
{

    public function appName(): string
    {
        return 'web';
    }

    public function subscribes(): array
    {
        return [
            WebDetectTestEnvSubscriber::class,
        ];
    }

    public function import(): array
    {
        return ['i18next', 'container', 'entityManager', 'eventDispatcher', 'rbac', 'symfonyRestApi'];
    }

    protected function configDispatcher(EventDispatcherConfiguratorInterface $configurator): void
    {
        $configurator->addSubscriber(FindRouteSubscriber::class);
        $configurator->addSubscriber(WebFirewallSubscriber::class);
    }

    protected function configContainer(ContainerConfiguratorInterface $containerConfigurator): void
    {
        $containerConfigurator->singleton(HttpKernelInterface::class, HttpKernel::class);
        $containerConfigurator->bind(ErrorRendererInterface::class, SerializerErrorRenderer::class);
//        $containerConfigurator->singleton(View::class, View::class);
        $containerConfigurator->singleton(RouteCollection::class, RouteCollection::class);
        $containerConfigurator->singleton(RequestStack::class, RequestStack::class);
        $containerConfigurator->singleton(UrlMatcherInterface::class, UrlMatcher::class);
        $containerConfigurator->singleton(RequestMatcherInterface::class, UrlMatcher::class);
//        $containerConfigurator->singleton('error_controller', ErrorController::class);
    }
}
