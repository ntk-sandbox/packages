<?php

namespace Untek\User\Notify\Domain\Repositories\Eloquent;

use Untek\Bundle\Eav\Domain\Interfaces\Repositories\EnumRepositoryInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\MeasureRepositoryInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\ValidationRepositoryInterface;
use Untek\Domain\Relation\Libs\Types\OneToManyRelation;
use Untek\Domain\Relation\Libs\Types\OneToOneRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\User\Notify\Domain\Entities\TypeTransportEntity;
use Untek\User\Notify\Domain\Interfaces\Repositories\TransportRepositoryInterface;
use Untek\User\Notify\Domain\Interfaces\Repositories\TypeRepositoryInterface;
use Untek\User\Notify\Domain\Interfaces\Repositories\TypeTransportRepositoryInterface;

class TypeTransportRepository extends BaseEloquentCrudRepository implements TypeTransportRepositoryInterface
{

    public function tableName() : string
    {
        return 'notify_type_transport';
    }

    public function getEntityClass() : string
    {
        return TypeTransportEntity::class;
    }

    public function relations()
    {
        return [
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'transport_id',
                'relationEntityAttribute' => 'transport',
                'foreignRepositoryClass' => TransportRepositoryInterface::class,
            ],
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'type_id',
                'relationEntityAttribute' => 'type',
                'foreignRepositoryClass' => TypeRepositoryInterface::class,
            ],
        ];
    }
}
