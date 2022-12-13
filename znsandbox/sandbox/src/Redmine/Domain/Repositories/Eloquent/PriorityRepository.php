<?php

namespace ZnSandbox\Sandbox\Redmine\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnSandbox\Sandbox\Redmine\Domain\Entities\PriorityEntity;
use ZnSandbox\Sandbox\Redmine\Domain\Interfaces\Repositories\PriorityRepositoryInterface;

class PriorityRepository extends BaseEloquentCrudRepository implements PriorityRepositoryInterface
{

    public function tableName() : string
    {
        return 'redmine_priority';
    }

    public function getEntityClass() : string
    {
        return PriorityEntity::class;
    }


}

