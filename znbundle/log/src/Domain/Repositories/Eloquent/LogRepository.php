<?php

namespace ZnBundle\Log\Domain\Repositories\Eloquent;

use ZnBundle\Log\Domain\Entities\LogEntity;
use ZnBundle\Log\Domain\Interfaces\Repositories\LogRepositoryInterface;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class LogRepository extends BaseEloquentCrudRepository implements LogRepositoryInterface
{

    public function tableName(): string
    {
        return 'log_history';
    }

    public function getEntityClass(): string
    {
        return LogEntity::class;
    }
}
