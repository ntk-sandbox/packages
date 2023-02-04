<?php

namespace Untek\User\Notify\Domain\Repositories\Eloquent;

use Untek\User\Notify\Domain\Entities\SettingEntity;
use Untek\User\Notify\Domain\Interfaces\Repositories\SettingRepositoryInterface;
use Untek\User\Notify\Domain\Interfaces\Repositories\TypeRepositoryInterface;
use Untek\Bundle\Person\Domain\Interfaces\Repositories\ContactTypeRepositoryInterface;
use Untek\Domain\Relation\Libs\Types\OneToOneRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class SettingRepository extends BaseEloquentCrudRepository implements SettingRepositoryInterface
{

    public function tableName(): string
    {
        return 'notify_setting';
    }

    public function getEntityClass(): string
    {
        return SettingEntity::class;
    }

    public function relations()
    {
        return [
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'notify_type_id',
                'relationEntityAttribute' => 'notifyType',
                'foreignRepositoryClass' => TypeRepositoryInterface::class,
            ],
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'contact_type_id',
                'relationEntityAttribute' => 'contactType',
                'foreignRepositoryClass' => ContactTypeRepositoryInterface::class,
            ],
        ];
    }
}
