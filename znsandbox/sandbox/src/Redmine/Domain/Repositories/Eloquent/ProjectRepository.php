<?php

namespace Untek\Sandbox\Sandbox\Redmine\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Sandbox\Sandbox\Redmine\Domain\Entities\ProjectEntity;
use Untek\Sandbox\Sandbox\Redmine\Domain\Interfaces\Repositories\ProjectRepositoryInterface;

class ProjectRepository extends BaseEloquentCrudRepository implements ProjectRepositoryInterface
{

    public function tableName() : string
    {
        return 'redmine_project';
    }

    public function getEntityClass() : string
    {
        return ProjectEntity::class;
    }


}

