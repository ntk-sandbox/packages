<?php

namespace ZnSandbox\Sandbox\Generator\Domain\Helpers;

use ZnCore\Collection\Libs\Collection;
use ZnDatabase\Base\Domain\Entities\TableEntity;
use ZnSandbox\Sandbox\Bundle\Domain\Entities\DomainEntity;
use ZnSandbox\Sandbox\Generator\Domain\Entities\AttributeEntity;
use ZnSandbox\Sandbox\Generator\Domain\Entities\EntityEntity;
use ZnSandbox\Sandbox\Generator\Domain\Entities\RepositoryEntity;
use ZnSandbox\Sandbox\Generator\Domain\Entities\ServiceEntity;

class TableMapperHelper
{

    public static function createEntityFromTable(DomainEntity $domainEntity, TableEntity $tableEntity): EntityEntity
    {
        $entityEntity = new EntityEntity();
        $entityEntity->setName(self::extractEntityNameFromTable($tableEntity->getName()));
        $entityEntity->setDomain($domainEntity);
        $attributeCollection = new Collection();
        foreach ($tableEntity->getColumns() as $columnEntity) {
            $attributeEntity = new AttributeEntity();
            $attributeEntity->setName($columnEntity->getName());
            $attributeEntity->setType($columnEntity->getType());
            $attributeEntity->setLength($columnEntity->getLength());
            $attributeEntity->setNullable($columnEntity->getNullable());
            $attributeCollection->add($attributeEntity);
        }
        $entityEntity->setAttributes($attributeCollection);
//            $entityEntity->setNamespace($domainEntity->getNamespace() . '\\Entities');
//            $entityEntity->setClassName($domainEntity->getNamespace() . '\\Entities\\' . Inflector::camelize($entityEntity->getName()) . 'Entity');
        return $entityEntity;
    }

    public static function createServiceFromTable(DomainEntity $domainEntity, TableEntity $tableEntity): ServiceEntity
    {
        $serviceEntity = new ServiceEntity();
        $serviceEntity->setName(self::extractEntityNameFromTable($tableEntity->getName()));
        $serviceEntity->setDomain($domainEntity);
        return $serviceEntity;
    }

    public static function createRepositoryFromTable(DomainEntity $domainEntity, TableEntity $tableEntity): RepositoryEntity
    {
        $repositoryEntity = new RepositoryEntity();
        $repositoryEntity->setName(self::extractEntityNameFromTable($tableEntity->getName()));
        $repositoryEntity->setDomain($domainEntity);
        return $repositoryEntity;
    }


    public static function extractDomainNameFromTable(string $tableName): string
    {
        $segments = explode('_', $tableName);
        return $segments[0];
    }

    public static function extractEntityNameFromTable(string $tableName): string
    {
        $segments = explode('_', $tableName);
        array_shift($segments);
        return implode('_', $segments);
    }

}
