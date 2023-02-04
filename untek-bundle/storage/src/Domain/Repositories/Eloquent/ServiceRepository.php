<?php

namespace Untek\Bundle\Storage\Domain\Repositories\Eloquent;

use Untek\Bundle\Storage\Domain\Entities\ServiceEntity;
use Untek\Bundle\Storage\Domain\Interfaces\Repositories\ServiceRepositoryInterface;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class ServiceRepository extends BaseEloquentCrudRepository implements ServiceRepositoryInterface
{

    public function tableName(): string
    {
        return 'storage_service';
    }

    public function getEntityClass(): string
    {
        return ServiceEntity::class;
    }


}

