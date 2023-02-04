<?php

namespace Untek\User\Rbac\Domain\Interfaces\Repositories;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Repository\Interfaces\CrudRepositoryInterface;

interface AssignmentRepositoryInterface extends CrudRepositoryInterface
{

    public function allByIdentityId(int $identityId, Query $query = null): Enumerable;
}

