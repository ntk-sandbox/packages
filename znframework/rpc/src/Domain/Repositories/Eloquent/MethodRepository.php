<?php

namespace Untek\Framework\Rpc\Domain\Repositories\Eloquent;

use Untek\Domain\Query\Entities\Query;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Framework\Rpc\Domain\Entities\MethodEntity;
use Untek\Framework\Rpc\Domain\Interfaces\Repositories\MethodRepositoryInterface;

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
