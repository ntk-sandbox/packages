<?php

namespace Untek\Bundle\Summary\Domain\Repositories\Eloquent;

use Untek\Bundle\Summary\Domain\Entities\CounterEntity;
use Untek\Bundle\Summary\Domain\Interfaces\Repositories\CounterRepositoryInterface;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class CounterRepository extends BaseEloquentCrudRepository implements CounterRepositoryInterface
{

    public function tableName(): string
    {
        return 'summary_counter';
    }

    public function getEntityClass(): string
    {
        return CounterEntity::class;
    }


}

