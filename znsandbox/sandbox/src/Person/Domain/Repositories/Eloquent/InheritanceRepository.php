<?php

namespace Untek\Sandbox\Sandbox\Person\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Sandbox\Sandbox\Person\Domain\Entities\InheritanceEntity;
use Untek\Sandbox\Sandbox\Person\Domain\Interfaces\Repositories\InheritanceRepositoryInterface;

class InheritanceRepository extends BaseEloquentCrudRepository implements InheritanceRepositoryInterface
{

    public function tableName() : string
    {
        return 'sandbox.person_inheritance';
    }

    public function getEntityClass() : string
    {
        return InheritanceEntity::class;
    }


}

