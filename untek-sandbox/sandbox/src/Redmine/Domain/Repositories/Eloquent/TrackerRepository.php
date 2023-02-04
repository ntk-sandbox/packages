<?php

namespace Untek\Sandbox\Sandbox\Redmine\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Sandbox\Sandbox\Redmine\Domain\Entities\TrackerEntity;
use Untek\Sandbox\Sandbox\Redmine\Domain\Interfaces\Repositories\TrackerRepositoryInterface;

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

