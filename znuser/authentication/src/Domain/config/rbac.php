<?php

use ZnUser\Authentication\Domain\Enums\Rbac\AuthenticationPermissionEnum;
use ZnUser\Authentication\Domain\Enums\Rbac\ImitationAuthenticationPermissionEnum;
use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;
use ZnUser\Authentication\Domain\Enums\Rbac\AuthenticationIdentityPermissionEnum;

return [
    'roleEnums' => [

    ],
    'permissionEnums' => [
        AuthenticationPermissionEnum::class,
        ImitationAuthenticationPermissionEnum::class,
    ],
    'inheritance' => [
        SystemRoleEnum::GUEST => [
            AuthenticationPermissionEnum::AUTHENTICATION_WEB_LOGIN,
            AuthenticationPermissionEnum::AUTHENTICATION_GET_TOKEN_BY_PASSWORD,
            AuthenticationIdentityPermissionEnum::GET_MY_IDENTITY,
        ],
        SystemRoleEnum::USER => [
            AuthenticationPermissionEnum::AUTHENTICATION_WEB_LOGOUT,
        ],
        SystemRoleEnum::ADMINISTRATOR => [
            ImitationAuthenticationPermissionEnum::IMITATION,
        ],
    ],
];
