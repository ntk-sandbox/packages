<?php

namespace Untek\User\Rbac\Domain\Repositories\Eloquent;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Relation\Libs\Types\OneToOneRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\User\Rbac\Domain\Entities\AssignmentEntity;
use Untek\User\Rbac\Domain\Interfaces\Repositories\AssignmentRepositoryInterface;
use Untek\User\Rbac\Domain\Interfaces\Repositories\ItemRepositoryInterface;

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
