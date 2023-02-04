<?php

namespace Untek\Sandbox\Sandbox\Person2\Domain\Repositories\Eloquent;

use Untek\Domain\Relation\Libs\Types\OneToOneRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Sandbox\Sandbox\Person2\Domain\Entities\InheritanceEntity;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Repositories\InheritanceRepositoryInterface;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Repositories\PersonRepositoryInterface;

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
