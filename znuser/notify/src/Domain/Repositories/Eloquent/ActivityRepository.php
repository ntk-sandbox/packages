<?php

namespace Untek\User\Notify\Domain\Repositories\Eloquent;

use Untek\User\Notify\Domain\Entities\ActivityEntity;
use Untek\User\Notify\Domain\Interfaces\Repositories\ActivityRepositoryInterface;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class ActivityRepository extends BaseEloquentCrudRepository implements ActivityRepositoryInterface
{

    public function tableName(): string
    {
        return 'notify_activity';
    }

    public function getEntityClass(): string
    {
        return ActivityEntity::class;
    }
}
