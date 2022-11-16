<?php

use ZnSandbox\Sandbox\RpcMock\Rpc\Controllers\MethodController;
use ZnSandbox\Sandbox\RpcMock\Domain\Enums\Rbac\RpcMockMethodPermissionEnum;

return [
    [
        'method_name' => 'rpcMockMethod.all',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => RpcMockMethodPermissionEnum::ALL,
        'handler_class' => MethodController::class,
        'handler_method' => 'all',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'rpcMockMethod.oneById',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => RpcMockMethodPermissionEnum::ONE,
        'handler_class' => MethodController::class,
        'handler_method' => 'oneById',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'rpcMockMethod.create',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => RpcMockMethodPermissionEnum::CREATE,
        'handler_class' => MethodController::class,
        'handler_method' => 'add',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'rpcMockMethod.update',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => RpcMockMethodPermissionEnum::UPDATE,
        'handler_class' => MethodController::class,
        'handler_method' => 'update',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'rpcMockMethod.delete',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => RpcMockMethodPermissionEnum::DELETE,
        'handler_class' => MethodController::class,
        'handler_method' => 'delete',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],

];