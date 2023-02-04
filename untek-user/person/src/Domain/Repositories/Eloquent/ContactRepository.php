<?php

namespace Untek\User\Person\Domain\Repositories\Eloquent;

use Untek\Bundle\Eav\Domain\Interfaces\Repositories\AttributeRepositoryInterface;
use Untek\Domain\Relation\Libs\Types\OneToOneRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\User\Person\Domain\Entities\ContactEntity;
use Untek\User\Person\Domain\Interfaces\Repositories\ContactRepositoryInterface;

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
