<?php

namespace Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Repositories;

use Untek\Model\Repository\Interfaces\CrudRepositoryInterface;
use Untek\Model\Query\Entities\Query;
use Untek\Sandbox\Sandbox\Person2\Domain\Entities\PersonEntity;

interface PersonRepositoryInterface
{

    public function findOneByIdentityId(int $identityId, Query $query = null): PersonEntity;

}

