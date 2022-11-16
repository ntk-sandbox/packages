<?php

namespace ZnUser\Rbac\Domain\Facades;

use ZnDomain\Entity\Helpers\EntityHelper;
use ZnUser\Rbac\Domain\Libs\InheritanceMap;
use ZnUser\Rbac\Domain\Libs\MapItem;

class FixtureGeneratorFacade
{

    public static function generateInheritanceCollection(string $configFile = null): array
    {
        $inheritanceMap = new InheritanceMap($configFile);
        if($configFile == null) {
            $config = \ZnUser\Rbac\Domain\Helpers\RbacConfigHelper::getAll();
            $inheritanceMap->setConfig($config);
        }

        $mapItem = new MapItem($inheritanceMap);
        $result = $mapItem->run();
        $collection = [];
        foreach ($result['inheritance'] as $index => $entity) {
            $collection[] = EntityHelper::toArrayForTablize($entity);
        }
        return $collection;
    }

    public static function generateItemCollection(string $configFile = null): array
    {
        $inheritanceMap = new InheritanceMap($configFile);
        if($configFile == null) {
            $config = \ZnUser\Rbac\Domain\Helpers\RbacConfigHelper::getAll();
            $inheritanceMap->setConfig($config);
        }

        $mapItem = new MapItem($inheritanceMap);
        $result = $mapItem->run();
        $collection = [];
        foreach ($result['items'] as $index => $entity) {
            $collection[] = EntityHelper::toArrayForTablize($entity);
        }
        return $collection;
    }
}
