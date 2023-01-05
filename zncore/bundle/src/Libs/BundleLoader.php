<?php

namespace ZnCore\Bundle\Libs;

use Psr\Container\ContainerInterface;
use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\Bundle\Base\BaseBundle;
use ZnCore\Bundle\Base\BaseLoader;
use ZnCore\ConfigManager\Interfaces\ConfigManagerInterface;
use ZnCore\Container\Traits\ContainerAttributeTrait;
use ZnCore\Contract\Common\Exceptions\InvalidConfigException;
use ZnCore\Instance\Helpers\ClassHelper;
use ZnCore\Instance\Helpers\InstanceHelper;

/**
 * Загрузчик бандлов.
 */
class BundleLoader
{

    use ContainerAttributeTrait;

    private $bundles = [];
    private $import = [];
    private $loadersConfig = [];
    private $cache;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Зарегистрировать загрузчик конфигурации бандла.
     *
     * @param string $name Имя загрузчика
     * @param object | string | array $loader Объявление загрузчика
     */
    public function registerLoader(string $name, $loader)
    {
        $this->loadersConfig[$name] = $loader;
    }

    /**
     * Загрузить все конфиги приложения.
     */
    public function loadMainConfig(array $bundles = [], array $import = []): void
    {
        $this->addBundles($bundles);
        $loaders = $this->getLoadersConfig();
        $loaders = ArrayHelper::extractByKeys($loaders, $import);
        foreach ($loaders as $loaderName => $loaderDefinition) {
            $this->load($loaderName, $loaderDefinition);
        }
    }

    /**
     * Добавить бандлы.
     *
     * @param array $bundles Массив описания бандлов
     * @throws InvalidConfigException
     */
    protected function addBundles(array $bundles)
    {
        foreach ($bundles as $bundleDefinition) {
            $bundleInstance = $this->createBundleInstance($bundleDefinition);
            $bundleClass = get_class($bundleInstance);
            if (!isset($this->bundles[$bundleClass])) {
                if ($bundleInstance->deps()) {
                    $this->addBundles($bundleInstance->deps());
                }
                $this->bundles[$bundleClass] = $bundleInstance;
            }
        }
    }

    private function getLoadersConfig()
    {
        return $this->loadersConfig;
    }

    /**
     * Создать объект бандла.
     *
     * @param object | string | array $bundleDefinition Объявление бандла
     * @return BaseBundle
     * @throws InvalidConfigException
     */
    private function createBundleInstance($bundleDefinition): BaseBundle
    {
        /** @var BaseBundle $bundleInstance */
        if (is_object($bundleDefinition)) {
            $bundleInstance = $bundleDefinition;
        } elseif (is_string($bundleDefinition)) {
            $bundleInstance = InstanceHelper::create($bundleDefinition, [['all']]);
        } elseif (is_array($bundleDefinition)) {
            $bundleInstance = InstanceHelper::create($bundleDefinition);
        }
        return $bundleInstance;
    }

    private function load(string $loaderName, $loaderDefinition): void
    {
        /** @var BaseLoader $loaderInstance */
        $loaderInstance = ClassHelper::createObject($loaderDefinition);
        if ($loaderInstance->getName() == null) {
            $loaderInstance->setName($loaderName);
        }
        $bundles = $this->filterBundlesByLoader($this->bundles, $loaderName);
        $configManager = $this->container->get(ConfigManagerInterface::class);
        $configManager->set('bundles', $bundles);
        $loaderInstance->loadAll($bundles);
    }

    private function filterBundlesByLoader(array $bundles, string $loaderName): array
    {
        $resultBundles = [];
        foreach ($bundles as $bundle) {
            /** @var BaseBundle $bundle */
            $loaders = $bundle->getLoaders();
            if (in_array($loaderName, $loaders) || in_array('all', $loaders)) {
                $resultBundles[] = $bundle;
            }
        }
        return $resultBundles;
    }
}
