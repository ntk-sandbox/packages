<?php

namespace ZnSandbox\Sandbox\Person2\Domain\Repositories\Eloquent;

use ZnDomain\Relation\Libs\Types\OneToOneRelation;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnSandbox\Sandbox\Person2\Domain\Entities\InheritanceEntity;
use ZnSandbox\Sandbox\Person2\Domain\Interfaces\Repositories\InheritanceRepositoryInterface;
use ZnSandbox\Sandbox\Person2\Domain\Interfaces\Repositories\PersonRepositoryInterface;

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
