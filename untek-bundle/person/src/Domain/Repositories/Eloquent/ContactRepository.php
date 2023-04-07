<?php

namespace Untek\Bundle\Person\Domain\Repositories\Eloquent;

use Untek\Bundle\Person\Domain\Entities\ContactEntity;
use Untek\Bundle\Person\Domain\Interfaces\Repositories\ContactRepositoryInterface;
use Untek\Bundle\Person\Domain\Interfaces\Repositories\ContactTypeRepositoryInterface;
use Untek\Model\Relation\Libs\Types\OneToOneRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class ContactRepository extends BaseEloquentCrudRepository implements ContactRepositoryInterface
{

    public function tableName(): string
    {
        return 'person_contact';
    }

    public function getEntityClass(): string
    {
        return ContactEntity::class;
    }

    public function relations()
    {
        return [
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'type_id',
                'relationEntityAttribute' => 'type',
                'foreignRepositoryClass' => ContactTypeRepositoryInterface::class,
            ],
        ];
    }
}
