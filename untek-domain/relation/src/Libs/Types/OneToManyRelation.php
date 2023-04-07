<?php

namespace Untek\Model\Relation\Libs\Types;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Core\Collection\Libs\Collection;
use Untek\Model\Shared\Interfaces\FindAllInterface;
use Untek\Core\Code\Factories\PropertyAccess;
use Untek\Core\Collection\Helpers\CollectionHelper;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Relation\Interfaces\RelationInterface;

class OneToManyRelation extends BaseRelation implements RelationInterface
{

    /** Связующее поле */
    public $relationAttribute;

    //public $foreignPrimaryKey = 'id';
    //public $foreignAttribute = 'id';

    protected function loadRelation(Enumerable $collection): void
    {
        $ids = CollectionHelper::getColumn($collection, $this->relationAttribute);
        $ids = array_unique($ids);
        $foreignCollection = $this->loadRelationByIds($ids);
        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        foreach ($collection as $entity) {
            $relationIndex = $propertyAccessor->getValue($entity, $this->relationAttribute);
            if (!empty($relationIndex)) {
                $relCollection = [];
                foreach ($foreignCollection as $foreignEntity) {
                    $foreignValue = $propertyAccessor->getValue($foreignEntity, $this->foreignAttribute);
                    if ($foreignValue == $relationIndex) {
                        $relCollection[] = $foreignEntity;
                    }
                }
                $value = $relCollection;
                $value = $this->getValueFromPath($value);
                $propertyAccessor->setValue($entity, $this->relationEntityAttribute, new Collection($value));
            }
        }
    }

    protected function loadCollection(FindAllInterface $foreignRepositoryInstance, array $ids, Query $query): Enumerable
    {
        //$query->limit(count($ids));
        $collection = $foreignRepositoryInstance->findAll($query);
        return $collection;
    }
}
