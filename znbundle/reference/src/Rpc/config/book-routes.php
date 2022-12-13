<?php

use ZnBundle\Reference\Rpc\Controllers\BookController;
use ZnBundle\Reference\Domain\Enums\Rbac\ReferenceBookPermissionEnum;

return [
    [
        'method_name' => 'referenceBook.all',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => false,
        'permission_name' => ReferenceBookPermissionEnum::ALL,
        'handler_class' => BookController::class,
        'handler_method' => 'all',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'referenceBook.oneById',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => false,
        'permission_name' => ReferenceBookPermissionEnum::ONE,
        'handler_class' => BookController::class,
        'handler_method' => 'oneById',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'referenceBook.create',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => ReferenceBookPermissionEnum::CREATE,
        'handler_class' => BookController::class,
        'handler_method' => 'add',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'referenceBook.update',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => ReferenceBookPermissionEnum::UPDATE,
        'handler_class' => BookController::class,
        'handler_method' => 'update',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'referenceBook.delete',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => ReferenceBookPermissionEnum::DELETE,
        'handler_class' => BookController::class,
        'handler_method' => 'delete',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],

];