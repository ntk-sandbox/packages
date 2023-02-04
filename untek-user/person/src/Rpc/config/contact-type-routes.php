<?php

use Untek\User\Person\Domain\Enums\Rbac\MyContactPermissionEnum;

return [
    [
        'method_name' => 'contactType.all',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => false,
        'permission_name' => \Untek\User\Person\Domain\Enums\Rbac\ContactTypePermissionEnum::ALL,
        'handler_class' => \Untek\User\Person\Rpc\Controllers\ContactTypeController::class,
        'handler_method' => 'all',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
];