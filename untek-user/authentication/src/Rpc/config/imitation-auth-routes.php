<?php

use Untek\User\Authentication\Rpc\Controllers\ImitationController;
use Untek\User\Authentication\Domain\Enums\Rbac\ImitationAuthenticationPermissionEnum;

return [
    [
        'method_name' => 'authentication.getTokenByImitation',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => ImitationAuthenticationPermissionEnum::IMITATION,
        'handler_class' => ImitationController::class,
        'handler_method' => 'imitation',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
];