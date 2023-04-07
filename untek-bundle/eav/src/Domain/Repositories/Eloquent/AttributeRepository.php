<?php

namespace Untek\Bundle\Eav\Domain\Repositories\Eloquent;

use Untek\Bundle\Eav\Domain\Entities\AttributeEntity;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\AttributeRepositoryInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\EnumRepositoryInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\MeasureRepositoryInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\ValidationRepositoryInterface;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Relation\Libs\Types\OneToManyRelation;
use Untek\Model\Relation\Libs\Types\OneToOneRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

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
