<?php

namespace Untek\User\Notify\Domain\Repositories\Eloquent;

use Untek\User\Notify\Domain\Entities\TypeEntity;
use Untek\User\Notify\Domain\Interfaces\Repositories\TransportRepositoryInterface;
use Untek\User\Notify\Domain\Interfaces\Repositories\TypeI18nRepositoryInterface;
use Untek\User\Notify\Domain\Interfaces\Repositories\TypeRepositoryInterface;
use Untek\Model\Relation\Libs\Types\OneToManyRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\User\Notify\Domain\Interfaces\Repositories\TypeTransportRepositoryInterface;

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
