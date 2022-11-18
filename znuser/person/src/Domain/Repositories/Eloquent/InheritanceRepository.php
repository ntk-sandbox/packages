<?php

namespace ZnUser\Person\Domain\Repositories\Eloquent;

use ZnDomain\Relation\Libs\Types\OneToOneRelation;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnUser\Person\Domain\Entities\InheritanceEntity;
use ZnUser\Person\Domain\Interfaces\Repositories\InheritanceRepositoryInterface;
use ZnUser\Person\Domain\Interfaces\Repositories\PersonRepositoryInterface;

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
