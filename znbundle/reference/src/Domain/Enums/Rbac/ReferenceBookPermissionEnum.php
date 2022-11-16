<?php

namespace ZnBundle\Reference\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;
use ZnCore\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;
use ZnCore\Contract\Rbac\Traits\CrudRbacInheritanceTrait;

class ReferenceBookPermissionEnum implements GetLabelsInterface, GetRbacInheritanceInterface
{

    use CrudRbacInheritanceTrait;

    const CRUD = 'oReferenceBookCrud';
    const ALL = 'oReferenceBookAll';
    const ONE = 'oReferenceBookOne';
    const CREATE = 'oReferenceBookCreate';
    const UPDATE = 'oReferenceBookUpdate';
    const DELETE = 'oReferenceBookDelete';
    const RESTORE = 'oReferenceBookRestore';

    public static function getLabels()
    {
        return [
            self::CRUD => 'Справочник. Полный доступ',
            self::ALL => 'Справочник. Просмотр списка',
            self::ONE => 'Справочник. Просмотр записи',
            self::CREATE => 'Справочник. Создание',
            self::UPDATE => 'Справочник. Редактирование',
            self::DELETE => 'Справочник. Удаление',
            self::RESTORE => 'Справочник. Восстановление',
        ];
    }

}
