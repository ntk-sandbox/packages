<?php

namespace Untek\User\Notify\Domain\Repositories\Eloquent;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Core\Collection\Libs\Collection;
use Untek\Core\Collection\Helpers\CollectionHelper;
use Untek\Domain\Query\Entities\Query;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Lib\Components\Status\Enums\StatusEnum;
use Untek\User\Notify\Domain\Entities\TransportEntity;
use Untek\User\Notify\Domain\Entities\TypeTransportEntity;
use Untek\User\Notify\Domain\Interfaces\Repositories\TransportRepositoryInterface;

class TransportRepository extends BaseEloquentCrudRepository implements TransportRepositoryInterface
{

    public function tableName(): string
    {
        return 'notify_transport';
    }

    public function getEntityClass(): string
    {
        return TransportEntity::class;
    }

    public function allEnabledByTypeId(int $typeId): Enumerable
    {
        $query = new Query();
        $query->where('type_id', $typeId);
        $query->where('status_id', StatusEnum::ENABLED);
        $query->with('transport');
        $collectionVia = $this->getEntityManager()->getRepository(TypeTransportEntity::class)->findAll($query);
        $array = CollectionHelper::getColumn($collectionVia, 'transport');
        return new Collection($array);
    }
}
