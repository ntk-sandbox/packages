<?php

namespace ZnKaz\Eds\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnKaz\Eds\Domain\Entities\HostEntity;
use ZnKaz\Eds\Domain\Interfaces\Repositories\HostRepositoryInterface;

class HostRepository extends BaseEloquentCrudRepository implements HostRepositoryInterface
{

    public function tableName() : string
    {
        return 'eds_host';
    }

    public function getEntityClass() : string
    {
        return HostEntity::class;
    }


}

