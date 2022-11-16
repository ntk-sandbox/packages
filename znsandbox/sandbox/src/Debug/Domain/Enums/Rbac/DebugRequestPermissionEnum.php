<?php

namespace ZnSandbox\Sandbox\Debug\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;
use ZnCore\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;

class DebugRequestPermissionEnum implements GetLabelsInterface, GetRbacInheritanceInterface
{

    public const CRUD = 'oDebugRequestCrud';

    public const ALL = 'oDebugRequestAll';

    public const ONE = 'oDebugRequestOne';

    public const CREATE = 'oDebugRequestCreate';

    public const UPDATE = 'oDebugRequestUpdate';

    public const DELETE = 'oDebugRequestDelete';

    public const RESTORE = 'oDebugRequestRestore';

    public static function getLabels()
    {
        return [
            self::CRUD => 'DebugRequest. Полный доступ',
            self::ALL => 'DebugRequest. Просмотр списка',
            self::ONE => 'DebugRequest. Просмотр записи',
            self::CREATE => 'DebugRequest. Создание',
            self::UPDATE => 'DebugRequest. Редактирование',
            self::DELETE => 'DebugRequest. Удаление',
            self::RESTORE => 'DebugRequest. Восстановление',
        ];
    }

    public static function getInheritance()
    {
        return [
            self::CRUD => [
                self::ALL,
                self::ONE,
                self::CREATE,
                self::UPDATE,
                self::DELETE,
                self::RESTORE,
            ],
        ];
    }


}

