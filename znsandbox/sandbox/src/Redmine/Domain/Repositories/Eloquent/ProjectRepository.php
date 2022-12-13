<?php

namespace ZnSandbox\Sandbox\Redmine\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnSandbox\Sandbox\Redmine\Domain\Entities\ProjectEntity;
use ZnSandbox\Sandbox\Redmine\Domain\Interfaces\Repositories\ProjectRepositoryInterface;

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

