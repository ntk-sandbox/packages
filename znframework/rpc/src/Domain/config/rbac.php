<?php

use Untek\Framework\Rpc\Domain\Enums\Rbac\RpcMethodPermissionEnum;
use Untek\User\Rbac\Domain\Enums\Rbac\SystemRoleEnum;
use Untek\Framework\Rpc\Domain\Enums\Rbac\RpcDocPermissionEnum;
use Untek\Framework\Rpc\Domain\Enums\Rbac\RpcSettingsPermissionEnum;
use Untek\Framework\Rpc\Domain\Enums\Rbac\FixturePermissionEnum;

return [
    'roleEnums' => [

    ],
    'permissionEnums' => [
        RpcDocPermissionEnum::class,
        RpcSettingsPermissionEnum::class,
        FixturePermissionEnum::class,
        RpcMethodPermissionEnum::class,
    ],
    'inheritance' => [
        SystemRoleEnum::GUEST => [
            FixturePermissionEnum::FIXTURE_IMPORT,
            RpcMethodPermissionEnum::ALL,
            RpcMethodPermissionEnum::ONE,
        ],
        SystemRoleEnum::USER => [

        ],
        SystemRoleEnum::ADMINISTRATOR => [
            RpcDocPermissionEnum::ALL,
            RpcDocPermissionEnum::ONE,
            RpcDocPermissionEnum::DOWNLOAD,

            RpcSettingsPermissionEnum::UPDATE,
            RpcSettingsPermissionEnum::VIEW,
        ],
    ],
];
