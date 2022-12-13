<?php

namespace ZnUser\Rbac\Domain\Libs\BundleLoaders;

use ZnCore\Bundle\Base\BaseLoader;
use ZnCore\Arr\Helpers\ArrayHelper;

class RbacConfigLoader extends BaseLoader
{

    public function loadAll(array $bundles): void
    {
        /*$config = $this->getValueFromCache();
        if (empty($config)) {
            $config = $this->getConfig($bundles);
            $this->setValueToCache($config);
        }*/
        $config = $this->getConfig($bundles);
        $this->getConfigManager()->set('rbacConfig', $config);
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
