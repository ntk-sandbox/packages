<?php

namespace Untek\User\Rbac\Domain\Interfaces\Services;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Service\Interfaces\CrudServiceInterface;

interface AssignmentServiceInterface extends CrudServiceInterface
{

    public function getRolesByIdentityId(int $identityId): array;

    public function allByIdentityId(int $identityId, Query $query = null): Enumerable;
}

