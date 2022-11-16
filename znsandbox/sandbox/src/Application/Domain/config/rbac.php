<?php

use ZnSandbox\Sandbox\Application\Domain\Enums\Rbac\ApplicationPermissionEnum;
use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

return [
    'roleEnums' => [

    ],
    'permissionEnums' => [

    ],
    'inheritance' => [
        SystemRoleEnum::GUEST => [

        ],
        SystemRoleEnum::USER => [

        ],
        SystemRoleEnum::ADMINISTRATOR => [
            ApplicationPermissionEnum::ALL,
            ApplicationPermissionEnum::ONE,
            ApplicationPermissionEnum::CREATE,
            ApplicationPermissionEnum::UPDATE,
            ApplicationPermissionEnum::DELETE,
        ],
    ],
];
