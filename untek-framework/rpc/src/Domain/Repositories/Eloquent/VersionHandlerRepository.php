<?php

namespace Untek\Framework\Rpc\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Framework\Rpc\Domain\Entities\VersionHandlerEntity;
use Untek\Framework\Rpc\Domain\Interfaces\Repositories\VersionHandlerRepositoryInterface;

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

