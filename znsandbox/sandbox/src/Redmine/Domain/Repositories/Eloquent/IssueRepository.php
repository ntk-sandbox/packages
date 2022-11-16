<?php

namespace ZnSandbox\Sandbox\Redmine\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnSandbox\Sandbox\Redmine\Domain\Entities\IssueEntity;
use ZnSandbox\Sandbox\Redmine\Domain\Interfaces\Repositories\IssueRepositoryInterface;

class IssueRepository extends BaseEloquentCrudRepository implements IssueRepositoryInterface
{

    public function tableName() : string
    {
        return 'redmine_issue';
    }

    public function getEntityClass() : string
    {
        return IssueEntity::class;
    }


}

