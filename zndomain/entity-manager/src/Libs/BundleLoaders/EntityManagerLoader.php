<?php

namespace ZnDomain\EntityManager\Libs\BundleLoaders;

use ZnCore\Bundle\Base\BaseLoader;
use ZnCore\Instance\Libs\Resolvers\MethodParametersResolver;
use ZnDomain\EntityManager\Interfaces\EntityManagerConfiguratorInterface;

/**
 * Загрузчик конфигурации менеджера сущностей
 */
class EntityManagerLoader extends BaseLoader
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
        /** @var EntityManagerConfiguratorInterface $entityManagerConfigurator */
        $entityManagerConfigurator = $this
            ->getContainer()
            ->get(EntityManagerConfiguratorInterface::class);
        if (!empty($requiredConfig['entities'])) {
            foreach ($requiredConfig['entities'] as $entityClass => $repositoryInterface) {
                $entityManagerConfigurator->bindEntity($entityClass, $repositoryInterface);
            }
        }
    }

    private function loadFromCallback(callable $requiredConfig): void
    {
        /** @var EntityManagerConfiguratorInterface $entityManagerConfigurator */
        $entityManagerConfigurator = $this->getContainer()->get(EntityManagerConfiguratorInterface::class);
        $methodParametersResolverArgs[] = $entityManagerConfigurator;
        $methodParametersResolver = new MethodParametersResolver($this->getContainer());
        $params = $methodParametersResolver->resolveClosure($requiredConfig, $methodParametersResolverArgs);
        call_user_func_array($requiredConfig, $params);
    }
}
