<?php

namespace Untek\User\Rbac\Domain\Repositories\File;

use Untek\Domain\Query\Entities\Query;
use Untek\User\Rbac\Domain\Entities\PermissionEntity;
use Untek\User\Rbac\Domain\Entities\RoleEntity;
use Untek\User\Rbac\Domain\Enums\ItemTypeEnum;
use Untek\User\Rbac\Domain\Interfaces\Repositories\RoleRepositoryInterface;
use Untek\Domain\Components\FileRepository\Base\BaseFileCrudRepository;

class PermissionRepository extends ItemRepository implements RoleRepositoryInterface
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
