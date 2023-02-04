<?php

use Untek\User\Password\Domain\Enums\Rbac\SecurityPermissionEnum;
use Untek\User\Password\Rpc\Controllers\RestorePasswordController;
use Untek\User\Password\Rpc\Controllers\UpdatePasswordController;

return [
    [
        'method_name' => 'restorePassword.requestActivationCode',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => false,
        'permission_name' => SecurityPermissionEnum::RESTORE_PASSWORD_REQUEST_ACTIVATION_CODE,
        'handler_class' => RestorePasswordController::class,
        'handler_method' => 'requestActivationCode',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'restorePassword.createPassword',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => false,
        'permission_name' => SecurityPermissionEnum::RESTORE_PASSWORD_CREATE_PASSWORD,
        'handler_class' => RestorePasswordController::class,
        'handler_method' => 'createPassword',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'updatePassword.update',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => true,
        'permission_name' => SecurityPermissionEnum::UPDATE_PASSWORD_UPDATE,
        'handler_class' => UpdatePasswordController::class,
        'handler_method' => 'update',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
    [
        'method_name' => 'validatePassword.validate',
        'version' => '1',
        'is_verify_eds' => false,
        'is_verify_auth' => false,
        'permission_name' => SecurityPermissionEnum::VALIDATE_PASSWORD_UPDATE,
        'handler_class' => \Untek\User\Password\Rpc\Controllers\ValidatePasswordController::class,
        'handler_method' => 'validate',
        'status_id' => 100,
        'title' => null,
        'description' => null,
    ],
];
