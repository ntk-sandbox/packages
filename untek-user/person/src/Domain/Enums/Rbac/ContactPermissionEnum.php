<?php

namespace Untek\User\Person\Domain\Enums\Rbac;

use Untek\Core\Enum\Interfaces\GetLabelsInterface;

class ContactPermissionEnum implements GetLabelsInterface
{

    const ALL = 'oPersonContactAll';
    const ONE = 'oPersonContactOne';
    const CREATE = 'oPersonContactCreate';
    const UPDATE = 'oPersonContactUpdate';
    const DELETE = 'oPersonContactDelete';
//    const RESTORE = 'oPersonContactRestore';

    public static function getLabels()
    {
        return [
            self::ALL => 'Контакты. Просмотр списка',
            self::ONE => 'Контакты. Просмотр записи',
            self::CREATE => 'Контакты. Создание',
            self::UPDATE => 'Контакты. Редактирование',
            self::DELETE => 'Контакты. Удаление',
//            self::RESTORE => 'RBAC item. Восстановление',
        ];
    }
}