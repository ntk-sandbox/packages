<?php

use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;
use ZnBundle\Reference\Domain\Enums\Rbac\ReferenceBookPermissionEnum;
use ZnBundle\Reference\Domain\Enums\Rbac\ReferenceItemPermissionEnum;

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
