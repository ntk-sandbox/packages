<?php

namespace Untek\Bundle\Language\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Bundle\Language\Domain\Entities\BundleEntity;
use Untek\Bundle\Language\Domain\Interfaces\Repositories\BundleRepositoryInterface;

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

