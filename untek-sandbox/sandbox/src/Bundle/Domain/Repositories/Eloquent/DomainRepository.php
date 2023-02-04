<?php

namespace Untek\Sandbox\Sandbox\Bundle\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Sandbox\Sandbox\Bundle\Domain\Entities\DomainEntity;
use Untek\Sandbox\Sandbox\Bundle\Domain\Interfaces\Repositories\DomainRepositoryInterface;

class DomainRepository extends BaseEloquentCrudRepository implements DomainRepositoryInterface
{

    public function tableName() : string
    {
        return 'bundle_domain';
    }

    public function getEntityClass() : string
    {
        return DomainEntity::class;
    }


}

