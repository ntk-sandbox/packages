<?php

use Untek\Bundle\Language\Domain\Enums\Rbac\LanguageCurrentPermissionEnum;
use Untek\User\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

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
