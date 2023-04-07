<?php

namespace Untek\Sandbox\Sandbox\Person2\Domain\Repositories\Eloquent;

use Untek\Bundle\Eav\Domain\Interfaces\Repositories\AttributeRepositoryInterface;
use Untek\Model\Relation\Libs\Types\OneToOneRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Sandbox\Sandbox\Person2\Domain\Entities\ContactEntity;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Repositories\ContactRepositoryInterface;

class ContactRepository extends BaseEloquentCrudRepository implements ContactRepositoryInterface
{

    public function tableName() : string
    {
        return 'person_contact';
    }

    public function getEntityClass() : string
    {
        return ContactEntity::class;
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
