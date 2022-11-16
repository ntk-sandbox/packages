<?php

namespace ZnBundle\Storage\Domain\Repositories\Eloquent;

use ZnBundle\Storage\Domain\Entities\FileEntity;
use ZnBundle\Storage\Domain\Interfaces\Repositories\FileRepositoryInterface;
use ZnBundle\Storage\Domain\Interfaces\Repositories\UsageRepositoryInterface;
use ZnDomain\Relation\Libs\Types\OneToManyRelation;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class FileRepository extends BaseEloquentCrudRepository implements FileRepositoryInterface
{

    public function tableName(): string
    {
        return 'storage_file';
    }

    public function getEntityClass(): string
    {
        return FileEntity::class;
    }

    public function relations()
    {
        return [
            [
                'class' => OneToManyRelation::class,
                'relationAttribute' => 'id',
                'relationEntityAttribute' => 'usages',
                'foreignRepositoryClass' => UsageRepositoryInterface::class,
                'foreignAttribute' => 'file_id',
            ],
        ];
    }
}

