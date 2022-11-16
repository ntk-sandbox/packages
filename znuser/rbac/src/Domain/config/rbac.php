<?php

use ZnUser\Rbac\Domain\Enums\Rbac\ExtraPermissionEnum;
use ZnUser\Rbac\Domain\Enums\Rbac\RbacAssignmentEnum;
use ZnUser\Rbac\Domain\Enums\Rbac\RbacItemPermissionEnum;
use ZnUser\Rbac\Domain\Enums\Rbac\RbacMyAssignmentPermissionEnum;
use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

return [
    'roleEnums' => [

    ],
    'permissionEnums' => [
        RbacItemPermissionEnum::class,
        RbacAssignmentEnum::class,
        RbacMyAssignmentPermissionEnum::class,
        ExtraPermissionEnum::class,
    ],
    'inheritance' => [
        SystemRoleEnum::GUEST => [

        ],
        SystemRoleEnum::USER => [

        ],
        SystemRoleEnum::ADMINISTRATOR => [
            RbacItemPermissionEnum::ALL,
            RbacItemPermissionEnum::ONE,
            RbacItemPermissionEnum::CREATE,
            RbacItemPermissionEnum::UPDATE,
            RbacItemPermissionEnum::DELETE,

            RbacAssignmentEnum::ATTACH,
            RbacAssignmentEnum::DETACH,
            RbacAssignmentEnum::ALL_ROLES,

            ExtraPermissionEnum::ADMIN_ONLY,
            ExtraPermissionEnum::ADMIN_ONLY_ALL,
            ExtraPermissionEnum::ADMIN_ONLY_ONE,
            ExtraPermissionEnum::ADMIN_ONLY_CREATE,
            ExtraPermissionEnum::ADMIN_ONLY_UPDATE,
            ExtraPermissionEnum::ADMIN_ONLY_DELETE,
        ],
    ],
];
