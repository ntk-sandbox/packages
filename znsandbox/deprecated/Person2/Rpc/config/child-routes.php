<?php

use ZnSandbox\Sandbox\Person2\Domain\Enums\Rbac\ChildPermissionEnum;
use ZnSandbox\Sandbox\Person2\Rpc\Controllers\ChildController;

return [
    /*[
        'method_name' => 'child.all',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => ChildPermissionEnum::ALL,
        'handler_class' => ChildController::class,
        'handler_method' => 'all',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],*/
    [
        'method_name' => 'child.oneById',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => ChildPermissionEnum::ONE,
        'handler_class' => ChildController::class,
        'handler_method' => 'oneById',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'child.create',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => ChildPermissionEnum::CREATE,
        'handler_class' => ChildController::class,
        'handler_method' => 'add',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'child.persist',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => ChildPermissionEnum::CREATE,
        'handler_class' => ChildController::class,
        'handler_method' => 'persist',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'child.update',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => ChildPermissionEnum::UPDATE,
        'handler_class' => ChildController::class,
        'handler_method' => 'update',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    /*[
        'method_name' => 'child.delete',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => ChildPermissionEnum::DELETE,
        'handler_class' => ChildController::class,
        'handler_method' => 'delete',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],*/
];