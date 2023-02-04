<?php

namespace Untek\Bundle\Storage\Domain\Repositories\Eloquent;

use Untek\Bundle\Storage\Domain\Entities\FileEntity;
use Untek\Bundle\Storage\Domain\Interfaces\Repositories\FileRepositoryInterface;
use Untek\Bundle\Storage\Domain\Interfaces\Repositories\UsageRepositoryInterface;
use Untek\Domain\Relation\Libs\Types\OneToManyRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

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

