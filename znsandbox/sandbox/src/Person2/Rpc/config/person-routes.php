<?php

use ZnSandbox\Sandbox\Person2\Rpc\Controllers\ChildController;
use ZnSandbox\Sandbox\Person2\Domain\Enums\Rbac\PersonPersonPermissionEnum;
use ZnSandbox\Sandbox\Person2\Rpc\Controllers\PersonController;

return [
    /*[
        'method_name' => 'person.all',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => PersonPersonPermissionEnum::ALL,
        'handler_class' => ChildController::class,
        'handler_method' => 'all',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'person.oneById',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => PersonPersonPermissionEnum::ONE,
        'handler_class' => ChildController::class,
        'handler_method' => 'oneById',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],*/

    [
        'method_name' => 'person.persist',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => PersonPersonPermissionEnum::CREATE,
        'handler_class' => PersonController::class,
        'handler_method' => 'persist',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],

    /*[
        'method_name' => 'person.create',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => PersonPersonPermissionEnum::CREATE,
        'handler_class' => ChildController::class,
        'handler_method' => 'add',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'person.update',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => PersonPersonPermissionEnum::UPDATE,
        'handler_class' => ChildController::class,
        'handler_method' => 'update',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'person.delete',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => PersonPersonPermissionEnum::DELETE,
        'handler_class' => ChildController::class,
        'handler_method' => 'delete',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],*/
];