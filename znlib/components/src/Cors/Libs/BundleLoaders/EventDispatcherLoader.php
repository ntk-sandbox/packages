<?php

namespace ZnLib\Components\Cors\Libs\BundleLoaders;

use ZnCore\Bundle\Base\BaseLoader;
use ZnCore\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use ZnCore\Instance\Libs\Resolvers\MethodParametersResolver;
use ZnDomain\EntityManager\Interfaces\EntityManagerConfiguratorInterface;

/**
 * Загрузчик конфигурации диспетчера событий
 */
class EventDispatcherLoader extends BaseLoader
{

    public function loadAll(array $bundles): void
    {
        foreach ($bundles as $bundle) {
            $containerConfigList = $this->load($bundle);
            foreach ($containerConfigList as $containerConfig) {
                $this->importFromConfig($containerConfig);
            }
        }
    }

    private function importFromConfig($configFile): void
    {
        $requiredConfig = require($configFile);
        $this->loadFromCallback($requiredConfig);
    }

    private function loadFromCallback(callable $requiredConfig): void
    {
        /** @var EventDispatcherConfiguratorInterface $dispatcherConfigurator */
        $dispatcherConfigurator = $this->getContainer()->get(EventDispatcherConfiguratorInterface::class);
        $methodParametersResolverArgs[] = $dispatcherConfigurator;
        $methodParametersResolver = new MethodParametersResolver($this->getContainer());
        $params = $methodParametersResolver->resolveClosure($requiredConfig, $methodParametersResolverArgs);
        call_user_func_array($requiredConfig, $params);
    }
}
