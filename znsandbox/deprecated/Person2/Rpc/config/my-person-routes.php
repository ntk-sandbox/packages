<?php

use ZnSandbox\Sandbox\Person2\Domain\Enums\Rbac\MyPersonPermissionEnum;
use ZnSandbox\Sandbox\Person2\Rpc\Controllers\MyPersonController;

return [
    [
        'method_name' => 'myPerson.one',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => MyPersonPermissionEnum::ONE,
        'handler_class' => MyPersonController::class,
        'handler_method' => 'one',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'myPerson.update',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => MyPersonPermissionEnum::UPDATE,
        'handler_class' => MyPersonController::class,
        'handler_method' => 'update',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
];