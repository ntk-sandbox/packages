<?php

namespace Untek\Sandbox\Sandbox\Person2\Domain\Repositories\Eloquent;

use Untek\Bundle\Eav\Domain\Interfaces\Repositories\EnumRepositoryInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\MeasureRepositoryInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\ValidationRepositoryInterface;
use Untek\Bundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use Untek\User\Identity\Domain\Interfaces\Repositories\IdentityRepositoryInterface;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Relation\Libs\Types\OneToManyRelation;
use Untek\Model\Relation\Libs\Types\OneToOneRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Sandbox\Sandbox\Person2\Domain\Entities\PersonEntity;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Repositories\ContactRepositoryInterface;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Repositories\PersonRepositoryInterface;

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
