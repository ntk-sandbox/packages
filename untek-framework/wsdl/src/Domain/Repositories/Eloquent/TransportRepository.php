<?php

namespace Untek\Framework\Wsdl\Domain\Repositories\Eloquent;

use Untek\Framework\Wsdl\Domain\Entities\TransportEntity;
use Untek\Framework\Wsdl\Domain\Enums\StatusEnum;
use Untek\Framework\Wsdl\Domain\Interfaces\Repositories\TransportRepositoryInterface;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Model\Query\Entities\Query;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class TransportRepository extends BaseEloquentCrudRepository implements TransportRepositoryInterface
{

    public function tableName(): string
    {
        return 'wsdl_transport';
    }

    public function getEntityClass(): string
    {
        return TransportEntity::class;
    }

    public function allByNewStatus(Query $query = null): Enumerable
    {
        $query = $this->forgeQuery($query);
//        $query->limit(10);
        $query->where('status_id', StatusEnum::NEW);
        return $this->findAll($query);
    }
}
