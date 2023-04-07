<?php

namespace Untek\Sandbox\Sandbox\RpcMock\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Model\Repository\Mappers\JsonMapper;
use Untek\Sandbox\Sandbox\RpcMock\Domain\Entities\MethodEntity;

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

