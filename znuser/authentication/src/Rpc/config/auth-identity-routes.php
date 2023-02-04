<?php

return [
    [
        'method_name' => 'authenticationIndentity.getMyIdentity',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => \Untek\User\Authentication\Domain\Enums\Rbac\AuthenticationIdentityPermissionEnum::GET_MY_IDENTITY,
        'handler_class' => \Untek\User\Authentication\Rpc\Controllers\AuthIdentityController::class,
        'handler_method' => 'getMyIdentity',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
];