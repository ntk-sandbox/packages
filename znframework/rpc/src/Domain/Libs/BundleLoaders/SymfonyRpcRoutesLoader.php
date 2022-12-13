<?php

namespace ZnFramework\Rpc\Domain\Libs\BundleLoaders;

use ZnCore\Bundle\Base\BaseLoader;
use ZnCore\Arr\Helpers\ArrayHelper;

class SymfonyRpcRoutesLoader extends BaseLoader
{

    public function loadAll(array $bundles): void
    {
        /*$config = $this->getValueFromCache();
        if (empty($config)) {
            $config = $this->getConfig($bundles);
            $this->setValueToCache($config);
        }*/
        $config = $this->getConfig($bundles);
        $this->getConfigManager()->set('rpcRoutes', $config);
    }

    protected function getConfig(array $bundles): array
    {
        $config = [];
        foreach ($bundles as $bundle) {
            $loadedConfig = $this->load($bundle);
            $config = ArrayHelper::merge($config, $loadedConfig);
        }
        return $config;
    }
}
