<?php

use Untek\Sandbox\Sandbox\Application\Domain\Enums\Rbac\ApplicationPermissionEnum;
use Untek\User\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

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
