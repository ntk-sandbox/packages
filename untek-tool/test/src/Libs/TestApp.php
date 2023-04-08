<?php

namespace Untek\Tool\Test\Libs;

use Untek\Core\App\Interfaces\EnvironmentInterface;
use Untek\Core\App\Libs\DefaultEnvironment;
use Untek\Core\App\Subscribers\PhpErrorSubscriber;
use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Core\Container\Interfaces\ContainerConfiguratorInterface;
use Untek\Core\App\Base\BaseApp;
use Untek\Core\DotEnv\Domain\Interfaces\BootstrapInterface;
use Untek\Core\DotEnv\Domain\Libs\Vlucas\VlucasBootstrap;

class TestApp extends BaseApp
{

    protected function getMode(): string {
        return 'test';
    }

    protected function bundles(): array
    {
        $bundles = [
            new \Untek\Lib\Components\CommonTranslate\Bundle(['all']),
            new \Untek\Lib\Components\SymfonyTranslation\Bundle(['all']),
            new \Untek\Component\I18Next\Bundle(['all']),
            new \Untek\Lib\Components\DefaultApp\Bundle(['all']),
//            \Untek\Database\Eloquent\Bundle::class,
//            \Untek\Database\Fixture\Bundle::class,
        ];
        return ArrayHelper::merge($this->bundles, $bundles);
    }

    public function appName(): string
    {
        return 'test';
    }

    public function subscribes(): array
    {
        return [
//            WebDetectTestEnvSubscriber::class,
            PhpErrorSubscriber::class,
        ];
    }

    public function import(): array
    {
        return ['i18next', 'container', 'entityManager', 'eventDispatcher' /*, 'symfonyWeb'*/];
    }

    protected function configContainer(ContainerConfiguratorInterface $containerConfigurator): void
    {
        $containerConfigurator->singleton(EnvironmentInterface::class, DefaultEnvironment::class);
        $containerConfigurator->singleton(BootstrapInterface::class, VlucasBootstrap::class);

//        $containerConfigurator->singleton(HttpKernelInterface::class, HttpKernel::class);
//        $containerConfigurator->bind(ErrorRendererInterface::class, HtmlErrorRenderer::class);
//        $containerConfigurator->singleton(View::class, View::class);
    }
}
