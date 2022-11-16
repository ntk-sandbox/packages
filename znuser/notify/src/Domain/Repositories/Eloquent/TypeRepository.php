<?php

namespace ZnUser\Notify\Domain\Repositories\Eloquent;

use ZnUser\Notify\Domain\Entities\TypeEntity;
use ZnUser\Notify\Domain\Interfaces\Repositories\TransportRepositoryInterface;
use ZnUser\Notify\Domain\Interfaces\Repositories\TypeI18nRepositoryInterface;
use ZnUser\Notify\Domain\Interfaces\Repositories\TypeRepositoryInterface;
use ZnDomain\Relation\Libs\Types\OneToManyRelation;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnUser\Notify\Domain\Interfaces\Repositories\TypeTransportRepositoryInterface;

class TypeRepository extends BaseEloquentCrudRepository implements TypeRepositoryInterface
{

    public function tableName(): string
    {
        return 'notify_type';
    }

    public function getEntityClass(): string
    {
        return TypeEntity::class;
    }

    public function relations()
    {
        return [
            [
                'class' => OneToManyRelation::class,
                'relationAttribute' => 'id',
                'relationEntityAttribute' => 'i18n',
                'foreignRepositoryClass' => TypeI18nRepositoryInterface::class,
                'foreignAttribute' => 'type_id',
            ],
            [
                'class' => OneToManyRelation::class,
                'relationAttribute' => 'id',
                'relationEntityAttribute' => 'transports',
                'foreignRepositoryClass' => TypeTransportRepositoryInterface::class,
                'foreignAttribute' => 'type_id',
            ],


            /*[
                'class' => OneToManyRelation::class,
                'relationAttribute' => 'id',
                'relationEntityAttribute' => 'transports',
                'foreignRepositoryClass' => TypeTransportRepositoryInterface::class,
                'foreignAttribute' => 'type_id',
            ],*/
        ];
    }
}
