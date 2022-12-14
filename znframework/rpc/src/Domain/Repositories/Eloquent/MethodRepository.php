<?php

namespace ZnFramework\Rpc\Domain\Repositories\Eloquent;

use ZnDomain\Query\Entities\Query;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnFramework\Rpc\Domain\Entities\MethodEntity;
use ZnFramework\Rpc\Domain\Interfaces\Repositories\MethodRepositoryInterface;

class MethodRepository extends BaseEloquentCrudRepository implements MethodRepositoryInterface
{

    public function tableName() : string
    {
        return 'rpc_route';
    }

    public function getEntityClass() : string
    {
        return MethodEntity::class;
    }

    public function findOneByMethodName(string $method, int $version): MethodEntity
    {
        $query = new Query();
        $query->where('version', strval($version));
        $query->where('method_name', $method);
        return $this->findOne($query);
    }
}
