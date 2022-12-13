<?php

use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;
use ZnSandbox\Sandbox\RpcClient\Domain\Enums\Rbac\RpcClientFavoritePermissionEnum;
use ZnSandbox\Sandbox\RpcClient\Domain\Enums\Rbac\RpcClientHistoryPermissionEnum;
use ZnSandbox\Sandbox\RpcClient\Domain\Enums\Rbac\RpcClientRequestPermissionEnum;

return [
    'roleEnums' => [

    ],
    'permissionEnums' => [
        RpcClientRequestPermissionEnum::class,
        RpcClientHistoryPermissionEnum::class,
        RpcClientFavoritePermissionEnum::class,
    ],
    'inheritance' => [
        SystemRoleEnum::GUEST => [

        ],
        SystemRoleEnum::USER => [

        ],
        SystemRoleEnum::ADMINISTRATOR => [
            RpcClientRequestPermissionEnum::CRUD,
            RpcClientHistoryPermissionEnum::CRUD,
            RpcClientFavoritePermissionEnum::CRUD,
        ],
    ],
];
