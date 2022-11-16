<?php

namespace ZnUser\Notify\Domain\Repositories\Eloquent;

use ZnUser\Notify\Domain\Entities\SettingEntity;
use ZnUser\Notify\Domain\Interfaces\Repositories\SettingRepositoryInterface;
use ZnUser\Notify\Domain\Interfaces\Repositories\TypeRepositoryInterface;
use ZnBundle\Person\Domain\Interfaces\Repositories\ContactTypeRepositoryInterface;
use ZnDomain\Relation\Libs\Types\OneToOneRelation;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;

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
