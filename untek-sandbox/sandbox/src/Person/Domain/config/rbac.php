<?php

use Untek\Sandbox\Sandbox\Person\Domain\Enums\Rbac\AppPersonPermissionEnum;
use Untek\User\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

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
