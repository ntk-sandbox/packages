<?php

use ZnBundle\Dashboard\Domain\Enums\Rbac\DashboardPermissionEnum;
use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

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
