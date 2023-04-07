<?php

namespace Untek\User\Rbac\Domain\Repositories\Eloquent;

use Untek\Model\Query\Entities\Query;
use Untek\User\Rbac\Domain\Entities\ItemEntity;
use Untek\User\Rbac\Domain\Entities\RoleEntity;
use Untek\User\Rbac\Domain\Enums\ItemTypeEnum;

class RoleRepository extends ItemRepository
{

    public function getEntityClass(): string
    {
        return RoleEntity::class;
    }

    protected function forgeQuery(Query $query = null): Query
    {
        $query = parent::forgeQuery($query);
        $query->where('type', ItemTypeEnum::ROLE);
        return $query;
    }
}
