<?php

namespace ZnUser\Rbac\Domain\Repositories\Eloquent;

use ZnCore\Collection\Interfaces\Enumerable;
use ZnDomain\Query\Entities\Query;
use ZnDomain\Relation\Libs\Types\OneToOneRelation;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnUser\Rbac\Domain\Entities\AssignmentEntity;
use ZnUser\Rbac\Domain\Interfaces\Repositories\AssignmentRepositoryInterface;
use ZnUser\Rbac\Domain\Interfaces\Repositories\ItemRepositoryInterface;

class AssignmentRepository extends BaseEloquentCrudRepository implements AssignmentRepositoryInterface
{

    public function tableName(): string
    {
        return 'rbac_assignment';
    }

    public function getEntityClass(): string
    {
        return AssignmentEntity::class;
    }

    public function relations()
    {
        return [
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'item_name',
                'relationEntityAttribute' => 'item',
                'foreignAttribute' => 'name',
                'foreignRepositoryClass' => ItemRepositoryInterface::class,
            ],
        ];
    }

    public function allByIdentityId(int $identityId, Query $query = null): Enumerable
    {
        $query = $this->forgeQuery($query);
        $query->where('identity_id', $identityId);
        return $this->findAll($query);
    }
}
