<?php

namespace Untek\Bundle\Eav\Domain\Repositories\Eloquent;

use Untek\Bundle\Eav\Domain\Entities\MeasureEntity;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\MeasureRepositoryInterface;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class MeasureRepository extends BaseEloquentCrudRepository implements MeasureRepositoryInterface
{

    public function tableName(): string
    {
        return 'eav_measure';
    }

    public function getEntityClass(): string
    {
        return MeasureEntity::class;
    }

}
