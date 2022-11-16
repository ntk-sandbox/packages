<?php

namespace ZnUser\Rbac\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;
use ZnCore\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;

class ExtraPermissionEnum implements GetLabelsInterface, GetRbacInheritanceInterface
{

    const ADMIN_ONLY = 'oAdminOnly';

    const ADMIN_ONLY_ALL = 'oAdminOnlyAll';
    const ADMIN_ONLY_ONE = 'oAdminOnlyOne';
    const ADMIN_ONLY_CREATE = 'oAdminOnlyCreate';
    const ADMIN_ONLY_UPDATE = 'oAdminOnlyUpdate';
    const ADMIN_ONLY_DELETE = 'oAdminOnlyDelete';
//    const ADMIN_ONLY_RESTORE = 'oAdminOnlyRestore';

    public static function getLabels()
    {
        return [
            self::ADMIN_ONLY => 'Доступ только для админа',
            self::ADMIN_ONLY_ALL => 'Доступ только для админа. Просмотр списка',
            self::ADMIN_ONLY_ONE => 'Доступ только для админа. Просмотр записи',
            self::ADMIN_ONLY_CREATE => 'Доступ только для админа. Создание',
            self::ADMIN_ONLY_UPDATE => 'Доступ только для админа. Редактирование',
            self::ADMIN_ONLY_DELETE => 'Доступ только для админа. Удаление',
//            self::ADMIN_ONLY_RESTORE => 'Доступ только для админа. Восстановление',
        ];
    }

    public static function getInheritance()
    {
        return [
            SystemRoleEnum::ROOT => [
                self::ADMIN_ONLY
            ],
        ];
    }
}