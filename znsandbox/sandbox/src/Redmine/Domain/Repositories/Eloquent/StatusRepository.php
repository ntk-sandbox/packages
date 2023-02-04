<?php

namespace Untek\Sandbox\Sandbox\Redmine\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Sandbox\Sandbox\Redmine\Domain\Entities\StatusEntity;
use Untek\Sandbox\Sandbox\Redmine\Domain\Interfaces\Repositories\StatusRepositoryInterface;

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

