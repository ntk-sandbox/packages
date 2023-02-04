<?php

use Untek\User\Rbac\Domain\Enums\Rbac\SystemRoleEnum;
use Untek\User\Registration\Domain\Enums\Rbac\UserRegistrationPermissionEnum;

return [
    'roleEnums' => [
        SystemRoleEnum::class,
    ],
    'permissionEnums' => [
        UserRegistrationPermissionEnum::class,
    ],
    'inheritance' => [
        SystemRoleEnum::GUEST => [
            UserRegistrationPermissionEnum::REQUEST_ACTIVATION_CODE,
            UserRegistrationPermissionEnum::CREATE_ACCOUNT,
        ],
    ],
];
