<?php

namespace Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Repositories;

use Untek\Domain\Repository\Interfaces\CrudRepositoryInterface;
use Untek\Domain\Query\Entities\Query;
use Untek\Sandbox\Sandbox\Person2\Domain\Entities\PersonEntity;

interface PersonRepositoryInterface
{

    public function findOneByIdentityId(int $identityId, Query $query = null): PersonEntity;

}

