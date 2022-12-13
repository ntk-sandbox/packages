<?php

use ZnUser\Rbac\Domain\Enums\Rbac\RbacAssignmentEnum;
use ZnUser\Rbac\Rpc\Controllers\AssignmentController;

return [
    [
        'method_name' => 'rbacAssignment.attach',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => RbacAssignmentEnum::ATTACH,
        'handler_class' => AssignmentController::class,
        'handler_method' => 'attach',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'rbacAssignment.detach',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => RbacAssignmentEnum::DETACH,
        'handler_class' => AssignmentController::class,
        'handler_method' => 'detach',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'rbacAssignment.allRoles',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => RbacAssignmentEnum::DETACH,
        'handler_class' => AssignmentController::class,
        'handler_method' => 'allRoles',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
];
