<?php

namespace ZnUser\Notify\Domain\Repositories\Eloquent;

use ZnUser\Notify\Domain\Entities\ActivityEntity;
use ZnUser\Notify\Domain\Interfaces\Repositories\ActivityRepositoryInterface;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;

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
