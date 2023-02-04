<?php

namespace Untek\Sandbox\Sandbox\Redmine\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Sandbox\Sandbox\Redmine\Domain\Entities\IssueEntity;
use Untek\Sandbox\Sandbox\Redmine\Domain\Interfaces\Repositories\IssueRepositoryInterface;

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

