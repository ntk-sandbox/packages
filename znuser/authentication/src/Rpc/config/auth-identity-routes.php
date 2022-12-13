<?php

return [
    [
        'method_name' => 'authenticationIndentity.getMyIdentity',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => \ZnUser\Authentication\Domain\Enums\Rbac\AuthenticationIdentityPermissionEnum::GET_MY_IDENTITY,
        'handler_class' => \ZnUser\Authentication\Rpc\Controllers\AuthIdentityController::class,
        'handler_method' => 'getMyIdentity',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
];