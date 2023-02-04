<?php

use Untek\Bundle\Messenger\Domain\Enums\Rbac\MessengerChatPermissionEnum;
use Untek\Bundle\Messenger\Domain\Enums\Rbac\MessengerMessagePermissionEnum;
use Untek\User\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

return [
    'roleEnums' => [

    ],
    'permissionEnums' => [
        MessengerChatPermissionEnum::class,
        MessengerMessagePermissionEnum::class,
    ],
    'inheritance' => [
        SystemRoleEnum::USER => [
            MessengerChatPermissionEnum::CRUD,
            MessengerMessagePermissionEnum::CRUD,
        ],
    ],
];
