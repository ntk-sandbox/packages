<?php

namespace ZnBundle\Eav\Domain\Repositories\Eloquent;

use ZnBundle\Eav\Domain\Entities\AttributeEntity;
use ZnBundle\Eav\Domain\Interfaces\Repositories\AttributeRepositoryInterface;
use ZnBundle\Eav\Domain\Interfaces\Repositories\EnumRepositoryInterface;
use ZnBundle\Eav\Domain\Interfaces\Repositories\MeasureRepositoryInterface;
use ZnBundle\Eav\Domain\Interfaces\Repositories\ValidationRepositoryInterface;
use ZnDomain\Query\Entities\Query;
use ZnDomain\Relation\Libs\Types\OneToManyRelation;
use ZnDomain\Relation\Libs\Types\OneToOneRelation;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class AttributeRepository extends BaseEloquentCrudRepository implements AttributeRepositoryInterface
{

    public function tableName(): string
    {
        return 'eav_attribute';
    }

    public function getEntityClass(): string
    {
        return AttributeEntity::class;
    }

    public function relations()
    {
        return [
            [
                'class' => OneToManyRelation::class,
                'relationAttribute' => 'id',
                'relationEntityAttribute' => 'rules',
                'foreignRepositoryClass' => ValidationRepositoryInterface::class,
                'foreignAttribute' => 'attribute_id',
            ],
            [
                'class' => OneToManyRelation::class,
                'relationAttribute' => 'id',
                'relationEntityAttribute' => 'enums',
                'foreignRepositoryClass' => EnumRepositoryInterface::class,
                'foreignAttribute' => 'attribute_id',
            ],
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'unit_id',
                'relationEntityAttribute' => 'unit',
                'foreignRepositoryClass' => MeasureRepositoryInterface::class,
            ],
        ];
    }

    protected function forgeQuery(Query $query = null): Query
    {
        return parent::forgeQuery($query)
            ->with(['rules', 'enums', 'unit']);
    }
}
