<?php

namespace ZnSandbox\Sandbox\Application\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnSandbox\Sandbox\Application\Domain\Entities\EdsEntity;
use ZnSandbox\Sandbox\Application\Domain\Interfaces\Repositories\EdsRepositoryInterface;

class EdsRepository extends BaseEloquentCrudRepository implements EdsRepositoryInterface
{

    public function tableName() : string
    {
        return 'application_eds';
    }

    public function getEntityClass() : string
    {
        return EdsEntity::class;
    }


}

