<?php

namespace Untek\User\Rbac\Domain\Helpers;

use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Core\ConfigManager\Interfaces\ConfigManagerInterface;
use Untek\Core\Container\Helpers\ContainerHelper;

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
