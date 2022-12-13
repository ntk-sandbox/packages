<?php

namespace ZnSandbox\Sandbox\Application\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;

class ApplicationPermissionEnum implements GetLabelsInterface
{

    const ALL = 'oApplicationApplicationAll';
    const ONE = 'oApplicationApplicationOne';
    const CREATE = 'oApplicationApplicationCreate';
    const UPDATE = 'oApplicationApplicationUpdate';
    const DELETE = 'oApplicationApplicationDelete';
//    const RESTORE = 'oApplicationApplicationRestore';

    public static function getLabels()
    {
        return [
            self::ALL => 'Приложения. Просмотр списка',
            self::ONE => 'Приложения. Просмотр записи',
            self::CREATE => 'Приложения. Создание',
            self::UPDATE => 'Приложения. Редактирование',
            self::DELETE => 'Приложения. Удаление',
//            self::RESTORE => 'Приложения. Восстановление',
        ];
    }
}