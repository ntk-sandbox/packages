<?php

use ZnFramework\Rpc\Domain\Enums\Rbac\RpcMethodPermissionEnum;
use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;
use ZnFramework\Rpc\Domain\Enums\Rbac\RpcDocPermissionEnum;
use ZnFramework\Rpc\Domain\Enums\Rbac\RpcSettingsPermissionEnum;
use ZnFramework\Rpc\Domain\Enums\Rbac\FixturePermissionEnum;

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
