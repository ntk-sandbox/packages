<?php

namespace ZnFramework\Rpc\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnFramework\Rpc\Domain\Entities\VersionHandlerEntity;
use ZnFramework\Rpc\Domain\Interfaces\Repositories\VersionHandlerRepositoryInterface;

class VersionHandlerRepository extends BaseEloquentCrudRepository implements VersionHandlerRepositoryInterface
{

    public function tableName() : string
    {
        return 'security_version_handler';
    }

    public function getEntityClass() : string
    {
        return VersionHandlerEntity::class;
    }


}

