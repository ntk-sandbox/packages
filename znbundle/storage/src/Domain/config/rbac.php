<?php

use ZnBundle\Storage\Domain\Enums\Rbac\StorageFilePermissionEnum;
use ZnBundle\Storage\Domain\Enums\Rbac\StorageMyFilePermissionEnum;
use ZnBundle\Storage\Domain\Enums\Rbac\StorageServicePermissionEnum;
use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

return [
    'roleEnums' => [

    ],
    'permissionEnums' => [
        StorageFilePermissionEnum::class,
        StorageMyFilePermissionEnum::class,
        StorageServicePermissionEnum::class,
    ],
    'inheritance' => [
        SystemRoleEnum::GUEST => [

        ],
        SystemRoleEnum::USER => [

        ],
        SystemRoleEnum::ADMINISTRATOR => [

        ],
    ],
];
