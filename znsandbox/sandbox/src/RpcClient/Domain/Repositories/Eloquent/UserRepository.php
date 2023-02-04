<?php

namespace Untek\Sandbox\Sandbox\RpcClient\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Sandbox\Sandbox\RpcClient\Domain\Entities\UserEntity;
use Untek\Sandbox\Sandbox\RpcClient\Domain\Interfaces\Repositories\UserRepositoryInterface;

class UserRepository extends BaseEloquentCrudRepository implements UserRepositoryInterface
{

    public function tableName() : string
    {
        return 'rpc_client_user';
    }

    public function getEntityClass() : string
    {
        return UserEntity::class;
    }
}
