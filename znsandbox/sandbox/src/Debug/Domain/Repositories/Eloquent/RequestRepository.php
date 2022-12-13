<?php

namespace ZnSandbox\Sandbox\Debug\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnSandbox\Sandbox\Debug\Domain\Entities\RequestEntity;

class RequestRepository extends BaseEloquentCrudRepository
{

    public function tableName() : string
    {
        return 'debug_request';
    }

    public function getEntityClass() : string
    {
        return RequestEntity::class;
    }


}

