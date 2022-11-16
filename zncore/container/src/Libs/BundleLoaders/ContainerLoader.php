<?php

namespace ZnCore\Container\Libs\BundleLoaders;

use ZnCore\Bundle\Base\BaseLoader;
use ZnCore\Container\Interfaces\ContainerConfiguratorInterface;
use ZnCore\Container\Libs\ContainerConfigurators\ArrayContainerConfigurator;
use ZnCore\Instance\Libs\Resolvers\InstanceResolver;
use ZnCore\Instance\Libs\Resolvers\MethodParametersResolver;

/**
 * Загрузчик конфигурации контейнера
 */
class ContainerLoader extends BaseLoader
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
        if (is_array($requiredConfig)) {
            $this->loadFromArray($requiredConfig);
        } elseif (is_callable($requiredConfig)) {
            $this->loadFromCallback($requiredConfig);
        }
    }

    private function loadFromArray(array $requiredConfig): void
    {
        /** @var ContainerConfiguratorInterface $containerConfigurator */
        $containerConfigurator = $this
            ->getContainer()
            ->get(ContainerConfiguratorInterface::class);
        if (!empty($requiredConfig['singletons'])) {
            foreach ($requiredConfig['singletons'] as $abstract => $concrete) {
                $containerConfigurator->singleton($abstract, $concrete);
            }
        }
        if (!empty($requiredConfig['definitions'])) {
            foreach ($requiredConfig['definitions'] as $abstract => $concrete) {
                $containerConfigurator->bind($abstract, $concrete);
            }
        }
    }

    private function loadFromCallback(callable $requiredConfig): void
    {
        $instanceResolver = new InstanceResolver($this->getContainer());
        /** @var ArrayContainerConfigurator $containerConfigurator */
        $containerConfigurator = $instanceResolver->create(ArrayContainerConfigurator::class);
        $methodParametersResolverArgs = [
            $containerConfigurator
        ];
        $methodParametersResolver = new MethodParametersResolver($this->getContainer());
        $params = $methodParametersResolver->resolveClosure($requiredConfig, $methodParametersResolverArgs);
        call_user_func_array($requiredConfig, $params);
    }
}
