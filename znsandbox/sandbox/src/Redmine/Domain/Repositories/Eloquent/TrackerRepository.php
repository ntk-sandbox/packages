<?php

namespace ZnSandbox\Sandbox\Redmine\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnSandbox\Sandbox\Redmine\Domain\Entities\TrackerEntity;
use ZnSandbox\Sandbox\Redmine\Domain\Interfaces\Repositories\TrackerRepositoryInterface;

class TrackerRepository extends BaseEloquentCrudRepository implements TrackerRepositoryInterface
{

    public function tableName() : string
    {
        return 'redmine_tracker';
    }

    public function getEntityClass() : string
    {
        return TrackerEntity::class;
    }


}

