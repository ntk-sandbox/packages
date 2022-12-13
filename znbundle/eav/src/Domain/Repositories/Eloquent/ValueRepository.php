<?php

namespace ZnBundle\Eav\Domain\Repositories\Eloquent;

use ZnBundle\Eav\Domain\Entities\ValueEntity;
use ZnBundle\Eav\Domain\Interfaces\Repositories\AttributeRepositoryInterface;
use ZnBundle\Eav\Domain\Interfaces\Repositories\ValueRepositoryInterface;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnDomain\Query\Entities\Query;
use ZnDomain\Relation\Libs\Types\OneToOneRelation;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class ValueRepository extends BaseEloquentCrudRepository implements ValueRepositoryInterface
{

    public function tableName(): string
    {
        return 'eav_value';
    }

    public function getEntityClass(): string
    {
        return ValueEntity::class;
    }

    public function relations()
    {
        return [
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'attribute_id',
                'relationEntityAttribute' => 'attribute',
                'foreignRepositoryClass' => AttributeRepositoryInterface::class,
            ],
        ];
    }

    public function allValues(int $entityId, int $recordId, Query $query = null): Enumerable
    {
        $query = Query::forge($query);
        $query->where('entity_id', $entityId);
        $query->where('record_id', $recordId);
        $query->with(['attribute']);
        return $this->findAll($query);
    }
}
