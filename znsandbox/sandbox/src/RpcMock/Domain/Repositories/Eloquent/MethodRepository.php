<?php

namespace ZnSandbox\Sandbox\RpcMock\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnDomain\Repository\Mappers\JsonMapper;
use ZnSandbox\Sandbox\RpcMock\Domain\Entities\MethodEntity;

class MethodRepository extends BaseEloquentCrudRepository
{

    public function tableName(): string
    {
        return 'rpc_mock_method';
    }

    public function getEntityClass(): string
    {
        return MethodEntity::class;
    }

    public function mappers(): array
    {
        return [
            new JsonMapper(['body', 'meta', 'error', 'request']),
        ];
    }
}

