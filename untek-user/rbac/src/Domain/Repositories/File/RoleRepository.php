<?php

namespace Untek\User\Rbac\Domain\Repositories\File;

use Untek\Model\Query\Entities\Query;
use Untek\User\Rbac\Domain\Entities\RoleEntity;
use Untek\User\Rbac\Domain\Enums\ItemTypeEnum;
use Untek\User\Rbac\Domain\Interfaces\Repositories\RoleRepositoryInterface;
use Untek\Model\Components\FileRepository\Base\BaseFileCrudRepository;

class RoleRepository extends ItemRepository implements RoleRepositoryInterface
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
