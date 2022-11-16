<?php

namespace ZnSandbox\Sandbox\Person2\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;

class ChildPermissionEnum implements GetLabelsInterface
{

    const ALL = 'oPersonChildAll';
    const ONE = 'oPersonChildOne';
    const CREATE = 'oPersonChildCreate';
    const UPDATE = 'oPersonChildUpdate';
    const DELETE = 'oPersonChildDelete';
//    const RESTORE = 'oPersonChildRestore';

    public static function getLabels()
    {
        return [
            self::ALL => 'Дети. Просмотр списка',
            self::ONE => 'Дети. Просмотр записи',
            self::CREATE => 'Дети. Создание',
            self::UPDATE => 'Дети. Редактирование',
            self::DELETE => 'Дети. Удаление',
//            self::RESTORE => 'RBAC item. Восстановление',
        ];
    }
}