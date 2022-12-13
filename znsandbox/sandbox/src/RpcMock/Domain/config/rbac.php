<?php

use ZnSandbox\Sandbox\RpcMock\Domain\Enums\Rbac\RpcMockHandleMethodPermissionEnum;
use ZnSandbox\Sandbox\RpcMock\Domain\Enums\Rbac\RpcMockMethodPermissionEnum;
use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

return [
    'roleEnums' => [

    ],
    'permissionEnums' => [
        RpcMockMethodPermissionEnum::class,
        RpcMockHandleMethodPermissionEnum::class,
    ],
    'inheritance' => [
        SystemRoleEnum::GUEST => [
            RpcMockHandleMethodPermissionEnum::HANDLE
        ],
        SystemRoleEnum::USER => [

        ],
        SystemRoleEnum::ADMINISTRATOR => [
            RpcMockMethodPermissionEnum::CRUD,
        ],
    ],
];
