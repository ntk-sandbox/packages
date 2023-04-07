<?php

namespace Untek\User\Rbac\Domain\Repositories\Eloquent;

use Untek\Model\Query\Entities\Query;
use Untek\User\Rbac\Domain\Entities\ItemEntity;
use Untek\User\Rbac\Domain\Entities\PermissionEntity;
use Untek\User\Rbac\Domain\Enums\ItemTypeEnum;

class PermissionRepository extends ItemRepository
{

    public function getEntityClass(): string
    {
        return PermissionEntity::class;
    }

    protected function forgeQuery(Query $query = null): Query
    {
        $query = parent::forgeQuery($query);
        $query->where('type', ItemTypeEnum::PERMISSION);
        return $query;
    }
}
