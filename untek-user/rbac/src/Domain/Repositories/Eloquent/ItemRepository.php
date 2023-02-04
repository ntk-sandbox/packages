<?php

namespace Untek\User\Rbac\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\User\Rbac\Domain\Entities\ItemEntity;
use Untek\User\Rbac\Domain\Interfaces\Repositories\ItemRepositoryInterface;

class ItemRepository extends BaseEloquentCrudRepository implements ItemRepositoryInterface
{

    public function tableName() : string
    {
        return 'rbac_item';
    }

    public function getEntityClass() : string
    {
        return ItemEntity::class;
    }
}
