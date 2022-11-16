<?php

namespace ZnSandbox\Sandbox\Person2\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;

class MyChildPermissionEnum implements GetLabelsInterface
{

    const ALL = 'oPersonMyChildAll';
    const ONE = 'oPersonMyChildOne';
    const CREATE = 'oPersonMyChildCreate';
    const UPDATE = 'oPersonMyChildUpdate';
    const DELETE = 'oPersonMyChildDelete';
//    const RESTORE = 'oPersonMyChildRestore';

    public static function getLabels()
    {
        return [
            self::ALL => 'Мои дети. Просмотр списка',
            self::ONE => 'Мои дети. Просмотр записи',
            self::CREATE => 'Мои дети. Создание',
            self::UPDATE => 'Мои дети. Редактирование',
            self::DELETE => 'Мои дети. Удаление',
//            self::RESTORE => 'RBAC item. Восстановление',
        ];
    }
}