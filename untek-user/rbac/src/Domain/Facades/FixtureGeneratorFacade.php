<?php

namespace Untek\User\Rbac\Domain\Facades;

use Untek\Domain\Entity\Helpers\EntityHelper;
use Untek\User\Rbac\Domain\Libs\InheritanceMap;
use Untek\User\Rbac\Domain\Libs\MapItem;

class FixtureGeneratorFacade
{

    public static function generateInheritanceCollection(string $configFile = null): array
    {
        $inheritanceMap = new InheritanceMap($configFile);
        if($configFile == null) {
            $config = \Untek\User\Rbac\Domain\Helpers\RbacConfigHelper::getAll();
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
            $config = \Untek\User\Rbac\Domain\Helpers\RbacConfigHelper::getAll();
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
