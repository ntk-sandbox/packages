<?php

namespace ZnUser\Rbac\Domain\Interfaces\Repositories;

use ZnDomain\Repository\Interfaces\RepositoryInterface;

interface ManagerRepositoryInterface extends RepositoryInterface
{

    public function allItemsByRoleName(string $roleName): array;
}
