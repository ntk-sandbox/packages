<?php

namespace Untek\Bundle\Geo\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Bundle\Geo\Domain\Entities\CurrencyEntity;
use Untek\Bundle\Geo\Domain\Interfaces\Repositories\CurrencyRepositoryInterface;

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

