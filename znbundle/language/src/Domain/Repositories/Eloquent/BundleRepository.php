<?php

namespace ZnBundle\Language\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnBundle\Language\Domain\Entities\BundleEntity;
use ZnBundle\Language\Domain\Interfaces\Repositories\BundleRepositoryInterface;

class BundleRepository extends BaseEloquentCrudRepository implements BundleRepositoryInterface
{

    public function tableName() : string
    {
        return 'language_bundle';
    }

    public function getEntityClass() : string
    {
        return BundleEntity::class;
    }


}

