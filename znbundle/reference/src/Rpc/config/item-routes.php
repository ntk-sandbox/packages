<?php

use Untek\Bundle\Reference\Rpc\Controllers\ItemController;
use Untek\Bundle\Reference\Domain\Enums\Rbac\ReferenceItemPermissionEnum;

return [
    [
        'method_name' => 'referenceItem.all',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => false,
        'permission_name' => ReferenceItemPermissionEnum::ALL,
        'handler_class' => ItemController::class,
        'handler_method' => 'all',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'referenceItem.oneById',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => false,
        'permission_name' => ReferenceItemPermissionEnum::ONE,
        'handler_class' => ItemController::class,
        'handler_method' => 'oneById',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'referenceItem.create',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => ReferenceItemPermissionEnum::CREATE,
        'handler_class' => ItemController::class,
        'handler_method' => 'add',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'referenceItem.update',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => ReferenceItemPermissionEnum::UPDATE,
        'handler_class' => ItemController::class,
        'handler_method' => 'update',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'referenceItem.delete',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => ReferenceItemPermissionEnum::DELETE,
        'handler_class' => ItemController::class,
        'handler_method' => 'delete',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],

];