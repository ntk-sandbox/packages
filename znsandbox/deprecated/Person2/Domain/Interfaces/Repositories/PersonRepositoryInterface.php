<?php

namespace ZnSandbox\Sandbox\Person2\Domain\Interfaces\Repositories;

use ZnDomain\Repository\Interfaces\CrudRepositoryInterface;
use ZnDomain\Query\Entities\Query;
use ZnSandbox\Sandbox\Person2\Domain\Entities\PersonEntity;

interface PersonRepositoryInterface
{

    public function findOneByIdentityId(int $identityId, Query $query = null): PersonEntity;

}

