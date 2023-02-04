<?php

use Untek\User\Rbac\Domain\Enums\Rbac\SystemRoleEnum;
use Untek\Sandbox\Sandbox\RpcClient\Domain\Enums\Rbac\RpcClientFavoritePermissionEnum;
use Untek\Sandbox\Sandbox\RpcClient\Domain\Enums\Rbac\RpcClientHistoryPermissionEnum;
use Untek\Sandbox\Sandbox\RpcClient\Domain\Enums\Rbac\RpcClientRequestPermissionEnum;

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
