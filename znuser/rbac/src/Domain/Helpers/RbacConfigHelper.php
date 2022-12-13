<?php

namespace ZnUser\Rbac\Domain\Helpers;

use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\ConfigManager\Interfaces\ConfigManagerInterface;
use ZnCore\Container\Helpers\ContainerHelper;

class RbacConfigHelper
{

    public static function getAll(): array
    {
        $collection = [];
        $configFiles = self::getConfig();
        foreach ($configFiles as $file) {
            $routes = include $file;
            $collection = ArrayHelper::merge($collection, $routes);
        }
        return $collection;
    }

    private static function getConfig(): array
    {
        return self::getConfigManager()->get('rbacConfig');
    }

    private static function getConfigManager(): ConfigManagerInterface
    {
        return ContainerHelper::getContainer()->get(ConfigManagerInterface::class);
    }
}
