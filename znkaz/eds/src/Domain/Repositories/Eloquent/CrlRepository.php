<?php

namespace ZnKaz\Eds\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnKaz\Eds\Domain\Entities\CrlEntity;
use ZnKaz\Eds\Domain\Interfaces\Repositories\CrlRepositoryInterface;

class CrlRepository extends BaseEloquentCrudRepository implements CrlRepositoryInterface
{

    public function tableName() : string
    {
        return 'eds_crl';
    }

    public function getEntityClass() : string
    {
        return CrlEntity::class;
    }


}
