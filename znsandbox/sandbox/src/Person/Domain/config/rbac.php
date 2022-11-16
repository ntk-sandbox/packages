<?php

use ZnSandbox\Sandbox\Person\Domain\Enums\Rbac\AppPersonPermissionEnum;
use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

return [
    'roleEnums' => [
        SystemRoleEnum::class,
    ],
    'permissionEnums' => [
        AppPersonPermissionEnum::class,
    ],
    'inheritance' => [
        SystemRoleEnum::USER => [
            AppPersonPermissionEnum::PERSON_INFO_UPDATE,
            AppPersonPermissionEnum::PERSON_INFO_ONE,
        ],
    ],
];
