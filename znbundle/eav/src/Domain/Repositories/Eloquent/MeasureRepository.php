<?php

namespace ZnBundle\Eav\Domain\Repositories\Eloquent;

use ZnBundle\Eav\Domain\Entities\MeasureEntity;
use ZnBundle\Eav\Domain\Interfaces\Repositories\MeasureRepositoryInterface;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;

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
