<?php

namespace Untek\Sandbox\Sandbox\Contact\Domain\Repositories\Eloquent;

use Untek\Sandbox\Sandbox\Contact\Domain\Entities\ValueEntity;
use Untek\Sandbox\Sandbox\Contact\Domain\Interfaces\Repositories\ValueRepositoryInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\AttributeRepositoryInterface;
use Untek\Model\Relation\Libs\Types\OneToOneRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class ValueRepository extends BaseEloquentCrudRepository implements ValueRepositoryInterface
{

    public function tableName(): string
    {
        return 'contact_value';
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
}
