<?php

namespace ZnSandbox\Sandbox\Person2\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;

class ContactTypePermissionEnum implements GetLabelsInterface
{

    const ALL = 'oPersonContactTypeAll';
    const ONE = 'oPersonContactTypeOne';
    const CREATE = 'oPersonContactTypeCreate';
    const UPDATE = 'oPersonContactTypeUpdate';
    const DELETE = 'oPersonContactTypeDelete';
//    const RESTORE = 'oPersonContactTypeRestore';

    public static function getLabels()
    {
        return [
            self::ALL => 'Тип контакта. Просмотр списка',
            self::ONE => 'Тип контакта. Просмотр записи',
            self::CREATE => 'Тип контакта. Создание',
            self::UPDATE => 'Тип контакта. Редактирование',
            self::DELETE => 'Тип контакта. Удаление',
//            self::RESTORE => 'RBAC item. Восстановление',
        ];
    }
}