<?php

return [
    [
        'method_name' => 'rbacMyAssignment.allRoles',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => \ZnUser\Rbac\Domain\Enums\Rbac\RbacMyAssignmentPermissionEnum::ALL,
        'handler_class' => \ZnUser\Rbac\Rpc\Controllers\MyAssignmentController::class,
        'handler_method' => 'allRoles',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'rbacMyAssignment.allPermissions',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => \ZnUser\Rbac\Domain\Enums\Rbac\RbacMyAssignmentPermissionEnum::ALL,
        'handler_class' => \ZnUser\Rbac\Rpc\Controllers\MyAssignmentController::class,
        'handler_method' => 'allPermissions',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
];
