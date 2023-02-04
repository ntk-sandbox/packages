<?php

namespace Untek\User\Rbac\Domain\Interfaces;

interface CheckAccessInterface
{

    public function checkAccess(?int $userId, string $permissionName, array $params = []);
}
