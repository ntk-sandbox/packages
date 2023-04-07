<?php

namespace Untek\User\Rbac\Domain\Interfaces\Repositories;

use Untek\Model\Repository\Interfaces\RepositoryInterface;

interface ManagerRepositoryInterface extends RepositoryInterface
{

    public function allItemsByRoleName(string $roleName): array;
}
