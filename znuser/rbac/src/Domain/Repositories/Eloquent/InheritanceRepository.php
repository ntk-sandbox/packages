<?php

namespace ZnUser\Rbac\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnUser\Rbac\Domain\Entities\InheritanceEntity;
use ZnUser\Rbac\Domain\Interfaces\Repositories\InheritanceRepositoryInterface;

class InheritanceRepository extends BaseEloquentCrudRepository implements InheritanceRepositoryInterface
{

    public function tableName() : string
    {
        return 'rbac_inheritance';
    }

    public function getEntityClass() : string
    {
        return InheritanceEntity::class;
    }


}

