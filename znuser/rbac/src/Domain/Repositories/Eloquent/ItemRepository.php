<?php

namespace ZnUser\Rbac\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnUser\Rbac\Domain\Entities\ItemEntity;
use ZnUser\Rbac\Domain\Interfaces\Repositories\ItemRepositoryInterface;

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

