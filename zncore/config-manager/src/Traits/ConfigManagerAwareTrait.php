<?php

namespace ZnCore\ConfigManager\Traits;

use ZnCore\Code\Helpers\DeprecateHelper;
use ZnCore\ConfigManager\Interfaces\ConfigManagerInterface;

DeprecateHelper::hardThrow();

trait ConfigManagerAwareTrait
{

    private $configManager;

    protected function getConfigManager(): ConfigManagerInterface
    {
        return $this->configManager;
    }

    protected function setConfigManager(ConfigManagerInterface $configManager): void
    {
        $this->configManager = $configManager;
    }
}
