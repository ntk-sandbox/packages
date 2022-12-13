<?php

namespace ZnUser\Rbac\Domain\Interfaces;

interface CheckAccessInterface
{

    public function checkAccess(?int $userId, string $permissionName, array $params = []);
}
