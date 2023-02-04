<?php

namespace Untek\Sandbox\Sandbox\Synchronize\Domain\Enums\Rbac;

use Untek\Core\Enum\Interfaces\GetLabelsInterface;
use Untek\Core\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;
use Untek\User\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

class SynchronizeSynchronizePermissionEnum implements GetLabelsInterface, GetRbacInheritanceInterface
{

    public const CRUD = 'oSynchronizeSynchronizeCrud';

    public const ALL = 'oSynchronizeSynchronizeAll';

//    public const ONE = 'oSynchronizeSynchronizeOne';

//    public const CREATE = 'oSynchronizeSynchronizeCreate';

    public const UPDATE = 'oSynchronizeSynchronizeUpdate';

//    public const DELETE = 'oSynchronizeSynchronizeDelete';

//    public const RESTORE = 'oSynchronizeSynchronizeRestore';

    public static function getLabels()
    {
        return [
            self::CRUD => 'SynchronizeSynchronize. Полный доступ',
            self::ALL => 'SynchronizeSynchronize. Просмотр списка',
//            self::ONE => 'SynchronizeSynchronize. Просмотр записи',
//            self::CREATE => 'SynchronizeSynchronize. Создание',
            self::UPDATE => 'SynchronizeSynchronize. Редактирование',
//            self::DELETE => 'SynchronizeSynchronize. Удаление',
//            self::RESTORE => 'SynchronizeSynchronize. Восстановление',
        ];
    }

    public static function getInheritance()
    {
        return [
            self::CRUD => [
                self::ALL,
//                self::ONE,
//                self::CREATE,
                self::UPDATE,
//                self::DELETE,
//                self::RESTORE,
            ],
            SystemRoleEnum::DEVELOPER => [
                self::CRUD,
            ]
        ];
    }
}
