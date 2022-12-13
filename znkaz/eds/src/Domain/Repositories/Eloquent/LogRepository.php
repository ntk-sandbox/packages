<?php

namespace ZnKaz\Eds\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnKaz\Eds\Domain\Entities\LogEntity;
use ZnKaz\Eds\Domain\Interfaces\Repositories\LogRepositoryInterface;

class LogRepository extends BaseEloquentCrudRepository implements LogRepositoryInterface
{

    public function tableName() : string
    {
        return 'eds_crl_log';
    }

    public function getEntityClass() : string
    {
        return LogEntity::class;
    }


}

