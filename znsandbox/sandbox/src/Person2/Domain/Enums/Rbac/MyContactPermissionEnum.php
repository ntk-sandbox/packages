<?php

namespace ZnSandbox\Sandbox\Person2\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;

class MyContactPermissionEnum implements GetLabelsInterface
{

    const ALL = 'oPersonMyContactAll';
    const ONE = 'oPersonMyContactOne';
    const CREATE = 'oPersonMyContactCreate';
    const UPDATE = 'oPersonMyContactUpdate';
    const DELETE = 'oPersonMyContactDelete';
//    const RESTORE = 'oPersonMyContactRestore';

    public static function getLabels()
    {
        return [
            self::ALL => 'Мои контакты. Просмотр списка',
            self::ONE => 'Мои контакты. Просмотр записи',
            self::CREATE => 'Мои контакты. Создание',
            self::UPDATE => 'Мои контакты. Редактирование',
            self::DELETE => 'Мои контакты. Удаление',
//            self::RESTORE => 'RBAC item. Восстановление',
        ];
    }
}