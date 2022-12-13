<?php

namespace ZnSandbox\Sandbox\Redmine\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnSandbox\Sandbox\Redmine\Domain\Entities\StatusEntity;
use ZnSandbox\Sandbox\Redmine\Domain\Interfaces\Repositories\StatusRepositoryInterface;

class StatusRepository extends BaseEloquentCrudRepository implements StatusRepositoryInterface
{

    public function tableName() : string
    {
        return 'redmine_status';
    }

    public function getEntityClass() : string
    {
        return StatusEntity::class;
    }


}

