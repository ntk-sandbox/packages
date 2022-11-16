<?php

use ZnSandbox\Sandbox\Person2\Domain\Enums\Rbac\ContactPermissionEnum;
use ZnSandbox\Sandbox\Person2\Rpc\Controllers\ContactController;

return [
    [
        'method_name' => 'contact.allByPersonId',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => ContactPermissionEnum::ALL,
        'handler_class' => ContactController::class,
        'handler_method' => 'allByPersonId',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'contact.oneById',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => ContactPermissionEnum::ONE,
        'handler_class' => ContactController::class,
        'handler_method' => 'oneById',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'contact.create',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => ContactPermissionEnum::CREATE,
        'handler_class' => ContactController::class,
        'handler_method' => 'add',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'contact.update',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => ContactPermissionEnum::UPDATE,
        'handler_class' => ContactController::class,
        'handler_method' => 'update',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'contact.delete',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => ContactPermissionEnum::DELETE,
        'handler_class' => ContactController::class,
        'handler_method' => 'delete',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
];