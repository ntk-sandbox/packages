<?php

namespace ZnSandbox\Sandbox\Person2\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;

class PersonPersonPermissionEnum implements GetLabelsInterface
{

    const ALL = 'oPersonPersonChildAll';
    const ONE = 'oPersonPersonChildOne';
    const CREATE = 'oPersonPersonChildCreate';
    const UPDATE = 'oPersonPersonChildUpdate';
    const DELETE = 'oPersonPersonChildDelete';
//    const RESTORE = 'oPersonPersonChildRestore';

    public static function getLabels()
    {
        return [
            self::ALL => 'Персона. Просмотр списка',
            self::ONE => 'Персона. Просмотр записи',
            self::CREATE => 'Персона. Создание',
            self::UPDATE => 'Персона. Редактирование',
            self::DELETE => 'Персона. Удаление',
//            self::RESTORE => 'RBAC item. Восстановление',
        ];
    }
}