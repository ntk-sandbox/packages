<?php

use Untek\User\Identity\Domain\Enums\Rbac\IdentityPermissionEnum;
use Untek\User\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

return [
    'roleEnums' => [
        SystemRoleEnum::class,
    ],
    'permissionEnums' => [
        IdentityPermissionEnum::class,
    ],
    'inheritance' => [
        SystemRoleEnum::ADMINISTRATOR => [
            IdentityPermissionEnum::ALL,
            IdentityPermissionEnum::ONE,
            IdentityPermissionEnum::CREATE,
            IdentityPermissionEnum::UPDATE,
            IdentityPermissionEnum::DELETE,
        ],
    ],
];
