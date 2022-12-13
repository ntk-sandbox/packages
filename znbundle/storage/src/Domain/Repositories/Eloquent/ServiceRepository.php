<?php

namespace ZnBundle\Storage\Domain\Repositories\Eloquent;

use ZnBundle\Storage\Domain\Entities\ServiceEntity;
use ZnBundle\Storage\Domain\Interfaces\Repositories\ServiceRepositoryInterface;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;

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

