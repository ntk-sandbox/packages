<?php

use Untek\Bundle\Dashboard\Domain\Enums\Rbac\DashboardPermissionEnum;
use Untek\User\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

return [
    'roleEnums' => [
        SystemRoleEnum::class,
    ],
    'permissionEnums' => [
        DashboardPermissionEnum::class,
    ],
    'inheritance' => [
        SystemRoleEnum::GUEST => [
            DashboardPermissionEnum::ALL,
        ],
    ],
];
