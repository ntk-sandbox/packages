<?php

use Untek\Bundle\Storage\Domain\Enums\Rbac\StorageFilePermissionEnum;
use Untek\Bundle\Storage\Domain\Enums\Rbac\StorageMyFilePermissionEnum;
use Untek\Bundle\Storage\Domain\Enums\Rbac\StorageServicePermissionEnum;
use Untek\User\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

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
