<?php

namespace Untek\Bundle\Storage\Domain\Repositories\Eloquent;

use Untek\Bundle\Storage\Domain\Interfaces\Repositories\FileRepositoryInterface;
use Untek\Bundle\Storage\Domain\Interfaces\Repositories\ServiceRepositoryInterface;
use Untek\User\Identity\Domain\Interfaces\Repositories\IdentityRepositoryInterface;
use Untek\Domain\Relation\Libs\Types\OneToOneRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Bundle\Storage\Domain\Entities\UsageEntity;
use Untek\Bundle\Storage\Domain\Interfaces\Repositories\UsageRepositoryInterface;

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
