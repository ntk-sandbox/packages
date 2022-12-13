<?php

namespace ZnBundle\Storage\Domain\Repositories\Eloquent;

use ZnBundle\Storage\Domain\Interfaces\Repositories\FileRepositoryInterface;
use ZnBundle\Storage\Domain\Interfaces\Repositories\ServiceRepositoryInterface;
use ZnUser\Identity\Domain\Interfaces\Repositories\IdentityRepositoryInterface;
use ZnDomain\Relation\Libs\Types\OneToOneRelation;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnBundle\Storage\Domain\Entities\UsageEntity;
use ZnBundle\Storage\Domain\Interfaces\Repositories\UsageRepositoryInterface;

class UsageRepository extends BaseEloquentCrudRepository implements UsageRepositoryInterface
{

    public function tableName() : string
    {
        return 'storage_file_usage';
    }

    public function getEntityClass() : string
    {
        return UsageEntity::class;
    }

    public function relations()
    {
        return [
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'service_id',
                'relationEntityAttribute' => 'service',
                'foreignRepositoryClass' => ServiceRepositoryInterface::class,
            ],
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'user_id',
                'relationEntityAttribute' => 'author',
                'foreignRepositoryClass' => IdentityRepositoryInterface::class,
            ],
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'file_id',
                'relationEntityAttribute' => 'file',
                'foreignRepositoryClass' => FileRepositoryInterface::class,
            ],
        ];
    }
}
