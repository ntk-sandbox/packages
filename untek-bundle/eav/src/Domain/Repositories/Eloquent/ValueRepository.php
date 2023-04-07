<?php

namespace Untek\Bundle\Eav\Domain\Repositories\Eloquent;

use Untek\Bundle\Eav\Domain\Entities\ValueEntity;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\AttributeRepositoryInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\ValueRepositoryInterface;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Relation\Libs\Types\OneToOneRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

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
