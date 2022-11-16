<?php

namespace ZnSandbox\Sandbox\Person2\Domain\Repositories\Eloquent;

use ZnBundle\Eav\Domain\Interfaces\Repositories\EnumRepositoryInterface;
use ZnBundle\Eav\Domain\Interfaces\Repositories\MeasureRepositoryInterface;
use ZnBundle\Eav\Domain\Interfaces\Repositories\ValidationRepositoryInterface;
use ZnBundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use ZnUser\Identity\Domain\Interfaces\Repositories\IdentityRepositoryInterface;
use ZnDomain\Query\Entities\Query;
use ZnDomain\Relation\Libs\Types\OneToManyRelation;
use ZnDomain\Relation\Libs\Types\OneToOneRelation;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnSandbox\Sandbox\Person2\Domain\Entities\PersonEntity;
use ZnSandbox\Sandbox\Person2\Domain\Interfaces\Repositories\ContactRepositoryInterface;
use ZnSandbox\Sandbox\Person2\Domain\Interfaces\Repositories\PersonRepositoryInterface;

class PersonRepository extends BaseEloquentCrudRepository implements PersonRepositoryInterface
{

    public function tableName(): string
    {
        return 'person_person';
    }

    public function getEntityClass(): string
    {
        return PersonEntity::class;
    }

    public function findOneByIdentityId(int $identityId, Query $query = null): PersonEntity
    {
        $query = Query::forge($query);
        $query->where('identity_id', $identityId);
        return $this->findOne($query);
    }

    public function relations()
    {
        return [
            [
                'class' => OneToManyRelation::class,
                'relationAttribute' => 'id',
                'relationEntityAttribute' => 'contacts',
                'foreignRepositoryClass' => ContactRepositoryInterface::class,
                'foreignAttribute' => 'person_id',
            ],
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'identity_id',
                'relationEntityAttribute' => 'identity',
                'foreignRepositoryClass' => IdentityRepositoryInterface::class
            ],
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'sex_id',
                'relationEntityAttribute' => 'sex',
                'foreignRepositoryClass' => ItemRepositoryInterface::class
            ],
        ];
    }
}
