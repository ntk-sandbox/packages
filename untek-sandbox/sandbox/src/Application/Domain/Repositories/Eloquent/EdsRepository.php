<?php

namespace Untek\Sandbox\Sandbox\Application\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Sandbox\Sandbox\Application\Domain\Entities\EdsEntity;
use Untek\Sandbox\Sandbox\Application\Domain\Interfaces\Repositories\EdsRepositoryInterface;

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

