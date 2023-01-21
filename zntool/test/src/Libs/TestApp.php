<?php

namespace ZnTool\Test\Libs;

use ZnCore\App\Interfaces\EnvironmentInterface;
use ZnCore\App\Libs\VlucasEnvironment;
use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\Container\Interfaces\ContainerConfiguratorInterface;
use ZnCore\App\Base\BaseApp;

class TestApp extends BaseApp
{

    protected function getMode(): string {
        return 'test';
    }

    protected function bundles(): array
    {
        $bundles = [
            new \ZnLib\Components\CommonTranslate\Bundle(['all']),
            new \ZnLib\Components\SymfonyTranslation\Bundle(['all']),
            new \ZnLib\I18Next\Bundle(['all']),
            new \ZnLib\Components\DefaultApp\Bundle(['all']),
//            \ZnDatabase\Eloquent\Bundle::class,
//            \ZnDatabase\Fixture\Bundle::class,
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
        ];
    }

    public function import(): array
    {
        return ['i18next', 'container', 'entityManager', 'eventDispatcher' /*, 'symfonyWeb'*/];
    }

    protected function configContainer(ContainerConfiguratorInterface $containerConfigurator): void
    {
        $containerConfigurator->singleton(EnvironmentInterface::class, VlucasEnvironment::class);

//        $containerConfigurator->singleton(HttpKernelInterface::class, HttpKernel::class);
//        $containerConfigurator->bind(ErrorRendererInterface::class, HtmlErrorRenderer::class);
//        $containerConfigurator->singleton(View::class, View::class);
    }
}
