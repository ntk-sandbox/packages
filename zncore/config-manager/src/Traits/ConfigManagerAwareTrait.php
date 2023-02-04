<?php

namespace Untek\Core\ConfigManager\Traits;

use Untek\Core\Code\Helpers\DeprecateHelper;
use Untek\Core\ConfigManager\Interfaces\ConfigManagerInterface;

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
