<?php

namespace ZnUser\Notify\Domain\Repositories\Eloquent;

use ZnCore\Collection\Interfaces\Enumerable;
use ZnCore\Collection\Libs\Collection;
use ZnCore\Collection\Helpers\CollectionHelper;
use ZnDomain\Query\Entities\Query;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnLib\Components\Status\Enums\StatusEnum;
use ZnUser\Notify\Domain\Entities\TransportEntity;
use ZnUser\Notify\Domain\Entities\TypeTransportEntity;
use ZnUser\Notify\Domain\Interfaces\Repositories\TransportRepositoryInterface;

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
