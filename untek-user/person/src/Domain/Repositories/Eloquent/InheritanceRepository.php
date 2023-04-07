<?php

namespace Untek\User\Person\Domain\Repositories\Eloquent;

use Untek\Model\Relation\Libs\Types\OneToOneRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\User\Person\Domain\Entities\InheritanceEntity;
use Untek\User\Person\Domain\Interfaces\Repositories\InheritanceRepositoryInterface;
use Untek\User\Person\Domain\Interfaces\Repositories\PersonRepositoryInterface;

class InheritanceRepository extends BaseEloquentCrudRepository implements InheritanceRepositoryInterface
{

    public function tableName(): string
    {
        return 'person_inheritance';
    }

    public function getEntityClass(): string
    {
        return InheritanceEntity::class;
    }

    public function relations()
    {
        return [
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'child_person_id',
                'relationEntityAttribute' => 'child_person',
                'foreignRepositoryClass' => PersonRepositoryInterface::class,
            ],
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'parent_person_id',
                'relationEntityAttribute' => 'parent_person',
                'foreignRepositoryClass' => PersonRepositoryInterface::class,
            ],
        ];
    }
}
