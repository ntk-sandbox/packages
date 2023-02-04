<?php

use Untek\User\Rbac\Domain\Enums\Rbac\SystemRoleEnum;
use Untek\Bundle\Reference\Domain\Enums\Rbac\ReferenceBookPermissionEnum;
use Untek\Bundle\Reference\Domain\Enums\Rbac\ReferenceItemPermissionEnum;

return [
    'roleEnums' => [

    ],
    'permissionEnums' => [
        ReferenceBookPermissionEnum::class,
        ReferenceItemPermissionEnum::class,
    ],
    'inheritance' => [
        SystemRoleEnum::GUEST => [
            ReferenceBookPermissionEnum::ALL,
            ReferenceBookPermissionEnum::ONE,

            ReferenceItemPermissionEnum::ALL,
            ReferenceItemPermissionEnum::ONE,
        ],
        SystemRoleEnum::ADMINISTRATOR => [
            ReferenceBookPermissionEnum::CREATE,
            ReferenceBookPermissionEnum::UPDATE,
            ReferenceBookPermissionEnum::DELETE,

            ReferenceItemPermissionEnum::CREATE,
            ReferenceItemPermissionEnum::UPDATE,
            ReferenceItemPermissionEnum::DELETE,
        ],
    ],
];
