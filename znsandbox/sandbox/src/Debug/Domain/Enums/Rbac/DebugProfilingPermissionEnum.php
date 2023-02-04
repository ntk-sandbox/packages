<?php

namespace Untek\Sandbox\Sandbox\Debug\Domain\Enums\Rbac;

use Untek\Core\Enum\Interfaces\GetLabelsInterface;
use Untek\Core\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;

class DebugProfilingPermissionEnum implements GetLabelsInterface, GetRbacInheritanceInterface
{

    public const CRUD = 'oDebugProfilingCrud';

    public const ALL = 'oDebugProfilingAll';

    public const ONE = 'oDebugProfilingOne';

    public const CREATE = 'oDebugProfilingCreate';

    public const UPDATE = 'oDebugProfilingUpdate';

    public const DELETE = 'oDebugProfilingDelete';

    public const RESTORE = 'oDebugProfilingRestore';

    public static function getLabels()
    {
        return [
            self::CRUD => 'DebugProfiling. Полный доступ',
            self::ALL => 'DebugProfiling. Просмотр списка',
            self::ONE => 'DebugProfiling. Просмотр записи',
            self::CREATE => 'DebugProfiling. Создание',
            self::UPDATE => 'DebugProfiling. Редактирование',
            self::DELETE => 'DebugProfiling. Удаление',
            self::RESTORE => 'DebugProfiling. Восстановление',
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

