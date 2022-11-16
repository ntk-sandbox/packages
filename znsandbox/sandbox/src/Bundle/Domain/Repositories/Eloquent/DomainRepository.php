<?php

namespace ZnSandbox\Sandbox\Bundle\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnSandbox\Sandbox\Bundle\Domain\Entities\DomainEntity;
use ZnSandbox\Sandbox\Bundle\Domain\Interfaces\Repositories\DomainRepositoryInterface;

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

