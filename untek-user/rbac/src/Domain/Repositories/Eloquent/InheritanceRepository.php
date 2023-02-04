<?php

namespace Untek\User\Rbac\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\User\Rbac\Domain\Entities\InheritanceEntity;
use Untek\User\Rbac\Domain\Interfaces\Repositories\InheritanceRepositoryInterface;

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

