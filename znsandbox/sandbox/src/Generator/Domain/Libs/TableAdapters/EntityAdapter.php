<?php

namespace Untek\Sandbox\Sandbox\Generator\Domain\Libs\TableAdapters;

use Untek\Core\Collection\Libs\Collection;
use Untek\Database\Base\Domain\Entities\TableEntity;
use Untek\Sandbox\Sandbox\Bundle\Domain\Entities\DomainEntity;
use Untek\Sandbox\Sandbox\Generator\Domain\Entities\AttributeEntity;
use Untek\Sandbox\Sandbox\Generator\Domain\Entities\EntityEntity;
use Untek\Sandbox\Sandbox\Generator\Domain\Helpers\TableMapperHelper;

class EntityAdapter extends BaseAdapter
{

    public function run(DomainEntity $domainEntity, TableEntity $tableEntity): EntityEntity
    {
        $entityEntity = new EntityEntity();
        $entityEntity->setName(TableMapperHelper::extractEntityNameFromTable($tableEntity->getName()));
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
}
