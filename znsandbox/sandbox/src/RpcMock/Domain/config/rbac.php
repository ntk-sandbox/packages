<?php

use Untek\Sandbox\Sandbox\RpcMock\Domain\Enums\Rbac\RpcMockHandleMethodPermissionEnum;
use Untek\Sandbox\Sandbox\RpcMock\Domain\Enums\Rbac\RpcMockMethodPermissionEnum;
use Untek\User\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

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
