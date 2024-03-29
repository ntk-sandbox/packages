<?php

use Untek\User\Password\Domain\Enums\Rbac\SecurityPermissionEnum;
use Untek\User\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

return [
    'roleEnums' => [
        SystemRoleEnum::class,
    ],
    'permissionEnums' => [
        SecurityPermissionEnum::class,
    ],
    'inheritance' => [
        SystemRoleEnum::GUEST => [
            SecurityPermissionEnum::RESTORE_PASSWORD_REQUEST_ACTIVATION_CODE,
            SecurityPermissionEnum::RESTORE_PASSWORD_CREATE_PASSWORD,
        ],
        SystemRoleEnum::USER => [
            SecurityPermissionEnum::UPDATE_PASSWORD_UPDATE,
        ],
    ],
];
