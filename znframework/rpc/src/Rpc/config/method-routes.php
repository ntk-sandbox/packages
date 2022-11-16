<?php

use ZnFramework\Rpc\Rpc\Controllers\MethodController;
use ZnFramework\Rpc\Domain\Enums\Rbac\RpcMethodPermissionEnum;

return [
    [
        'method_name' => 'rpcMethod.all',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => false,
        'permission_name' => RpcMethodPermissionEnum::ALL,
        'handler_class' => MethodController::class,
        'handler_method' => 'all',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    /*[
        'method_name' => 'rpcMethod.oneById',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => false,
        'permission_name' => RpcMethodPermissionEnum::ONE,
        'handler_class' => MethodController::class,
        'handler_method' => 'oneById',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'rpcMethod.create',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => RpcMethodPermissionEnum::CREATE,
        'handler_class' => MethodController::class,
        'handler_method' => 'add',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'rpcMethod.update',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => RpcMethodPermissionEnum::UPDATE,
        'handler_class' => MethodController::class,
        'handler_method' => 'update',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'rpcMethod.delete',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => RpcMethodPermissionEnum::DELETE,
        'handler_class' => MethodController::class,
        'handler_method' => 'delete',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],*/

];