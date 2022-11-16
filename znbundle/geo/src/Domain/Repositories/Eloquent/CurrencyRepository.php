<?php

namespace ZnBundle\Geo\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnBundle\Geo\Domain\Entities\CurrencyEntity;
use ZnBundle\Geo\Domain\Interfaces\Repositories\CurrencyRepositoryInterface;

class CurrencyRepository extends BaseEloquentCrudRepository implements CurrencyRepositoryInterface
{

    public function tableName() : string
    {
        return 'geo_currency';
    }

    public function getEntityClass() : string
    {
        return CurrencyEntity::class;
    }


}

