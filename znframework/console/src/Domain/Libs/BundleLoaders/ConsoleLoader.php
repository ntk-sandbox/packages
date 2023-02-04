<?php

namespace Untek\Framework\Console\Domain\Libs\BundleLoaders;

use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Core\Bundle\Base\BaseLoader;
use Untek\Core\ConfigManager\Interfaces\ConfigManagerInterface;

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
