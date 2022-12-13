<?php

use ZnBundle\Language\Domain\Enums\Rbac\LanguageCurrentPermissionEnum;
use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

return [
    'roleEnums' => [
        SystemRoleEnum::class,
    ],
    'permissionEnums' => [
        LanguageCurrentPermissionEnum::class,
    ],
    'inheritance' => [
        SystemRoleEnum::GUEST => [
            LanguageCurrentPermissionEnum::SWITCH,
        ],
    ],
];
