<?php

namespace Untek\Sandbox\Sandbox\Debug\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Sandbox\Sandbox\Debug\Domain\Entities\RequestEntity;

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

