<?php

namespace ZnUser\Notify\Domain\Repositories\Eloquent;

use ZnBundle\Eav\Domain\Interfaces\Repositories\EnumRepositoryInterface;
use ZnBundle\Eav\Domain\Interfaces\Repositories\MeasureRepositoryInterface;
use ZnBundle\Eav\Domain\Interfaces\Repositories\ValidationRepositoryInterface;
use ZnDomain\Relation\Libs\Types\OneToManyRelation;
use ZnDomain\Relation\Libs\Types\OneToOneRelation;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnUser\Notify\Domain\Entities\TypeTransportEntity;
use ZnUser\Notify\Domain\Interfaces\Repositories\TransportRepositoryInterface;
use ZnUser\Notify\Domain\Interfaces\Repositories\TypeRepositoryInterface;
use ZnUser\Notify\Domain\Interfaces\Repositories\TypeTransportRepositoryInterface;

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
