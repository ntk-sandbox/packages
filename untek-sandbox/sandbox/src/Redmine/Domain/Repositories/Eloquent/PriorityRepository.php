<?php

namespace Untek\Sandbox\Sandbox\Redmine\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Sandbox\Sandbox\Redmine\Domain\Entities\PriorityEntity;
use Untek\Sandbox\Sandbox\Redmine\Domain\Interfaces\Repositories\PriorityRepositoryInterface;

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

