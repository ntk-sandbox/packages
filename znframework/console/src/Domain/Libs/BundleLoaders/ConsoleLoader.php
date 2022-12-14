<?php

namespace ZnFramework\Console\Domain\Libs\BundleLoaders;

use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\Bundle\Base\BaseLoader;
use ZnCore\ConfigManager\Interfaces\ConfigManagerInterface;

class ConsoleLoader extends BaseLoader
{

    public function loadAll(array $bundles): void
    {
        $config = [];
        foreach ($bundles as $bundle) {
            $loadedConfig = $this->load($bundle);
            $config = ArrayHelper::merge($config, $loadedConfig);
        }
        $configManager = $this->getContainer()->get(ConfigManagerInterface::class);
        $configManager->set('consoleCommands', $config);
    }
}
