<?php

namespace Untek\Database\Migration\Domain\Libs\BundleLoaders;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;
use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Core\Bundle\Base\BaseLoader;
use Untek\Core\ConfigManager\Interfaces\ConfigManagerInterface;

class MigrationLoader extends BaseLoader
{

    public function __construct(
        ContainerInterface $container,
        ConfigManagerInterface $configManager
    ) {
        parent::__construct($container, $configManager);
    }

    public function loadAll(array $bundles): void
    {
        /*$config = $this->getValueFromCache();
        if (empty($config)) {
            $config = $this->getConfig($bundles);
            $this->setValueToCache($config);
        }*/
        $config = $this->getConfig($bundles);
        $this->getConfigManager()->set('ELOQUENT_MIGRATIONS', $config);
    }

    protected function getConfig(array $bundles): array
    {
        $config = [];
        foreach ($bundles as $bundle) {
            $i18nextBundles = $this->load($bundle);
            $config = ArrayHelper::merge($config, $i18nextBundles);
        }
        return $config;
    }
}
