<?php

use Untek\User\Person\Domain\Enums\Rbac\ChildPermissionEnum;
use Untek\User\Person\Domain\Enums\Rbac\ContactPermissionEnum;
use Untek\User\Person\Domain\Enums\Rbac\ContactTypePermissionEnum;
use Untek\User\Person\Domain\Enums\Rbac\MyChildPermissionEnum;
use Untek\User\Person\Domain\Enums\Rbac\MyContactPermissionEnum;
use Untek\User\Person\Domain\Enums\Rbac\MyPersonPermissionEnum;
use Untek\User\Person\Domain\Enums\Rbac\PersonPersonPermissionEnum;
use Untek\User\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

return [
    'roleEnums' => [

    ],
    'permissionEnums' => [
        MyPersonPermissionEnum::class,
        MyContactPermissionEnum::class,
        ContactPermissionEnum::class,
        MyChildPermissionEnum::class,
        ChildPermissionEnum::class,
        PersonPersonPermissionEnum::class,
        ContactTypePermissionEnum::class,
    ],
    'inheritance' => [
        SystemRoleEnum::GUEST => [

        ],
        SystemRoleEnum::USER => [
            MyPersonPermissionEnum::ONE,
            MyPersonPermissionEnum::UPDATE,

            MyContactPermissionEnum::ALL,
            MyContactPermissionEnum::ONE,
            MyContactPermissionEnum::CREATE,
            MyContactPermissionEnum::UPDATE,
            MyContactPermissionEnum::DELETE,

            MyChildPermissionEnum::ALL,
            MyChildPermissionEnum::ONE,
            MyChildPermissionEnum::CREATE,
            MyChildPermissionEnum::UPDATE,
            MyChildPermissionEnum::DELETE,
        ],
        SystemRoleEnum::ADMINISTRATOR => [

        ],
    ],
];
