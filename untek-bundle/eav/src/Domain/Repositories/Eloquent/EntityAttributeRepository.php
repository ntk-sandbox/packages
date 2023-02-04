<?php

namespace Untek\Bundle\Eav\Domain\Repositories\Eloquent;

use Untek\Bundle\Eav\Domain\Entities\EntityAttributeEntity;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\AttributeRepositoryInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\EntityAttributeRepositoryInterface;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Relation\Libs\Types\OneToOneRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class EntityAttributeRepository extends BaseEloquentCrudRepository implements EntityAttributeRepositoryInterface
{

    public function tableName(): string
    {
        return 'eav_entity_attribute';
    }

    public function getEntityClass(): string
    {
        return EntityAttributeEntity::class;
    }

    protected function forgeQuery(Query $query = null): Query
    {
        return parent::forgeQuery($query)->orderBy(['sort' => SORT_ASC]);
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
}

