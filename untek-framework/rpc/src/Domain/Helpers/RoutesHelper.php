<?php

namespace Untek\Framework\Rpc\Domain\Helpers;

use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Core\ConfigManager\Interfaces\ConfigManagerInterface;
use Untek\Core\Container\Helpers\ContainerHelper;
use Untek\User\Rbac\Domain\Facades\FixtureGeneratorFacade;

class RoutesHelper
{

    public static function getAllRoutes(): array {
        $collection = [];
        $routesPath = self::getRoutesPath();
        foreach ($routesPath as $file) {
            $routes = self::includeConfig($file);
            $collection = ArrayHelper::merge($collection, $routes);
        }
        $collection = self::loadTitle($collection);
        return $collection;
    }

    private static function includeConfig($file) {
        return include $file;
    }

    private static function loadTitle($collection) {
        $itemCollection = FixtureGeneratorFacade::generateItemCollection();
        $itemCollectionIndexed = ArrayHelper::index($itemCollection, 'name');
        foreach ($collection as &$item) {
            $permissionName = $item['permission_name'];
            $permissionItem = ArrayHelper::getValue($itemCollectionIndexed, $permissionName);
            if($permissionItem) {
                if(empty($item['title']) && !empty($permissionItem['title'])) {
                    $item['title'] = $permissionItem['title'];
                }
                if(empty($item['description']) && !empty($permissionItem['description'])) {
                    $item['description'] = $permissionItem['description'];
                }
            }
        }
        return $collection;
    }

    private static function getRoutesPath(): array {
        $routes = self::getConfigManager()->get('rpcRoutes');
        return $routes;
    }
    
    private static function getConfigManager(): ConfigManagerInterface {
        return ContainerHelper::getContainer()->get(ConfigManagerInterface::class);
    }
}
