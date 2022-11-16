<?php

namespace ZnBundle\Reference\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;
use ZnCore\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;
use ZnCore\Contract\Rbac\Traits\CrudRbacInheritanceTrait;

class ReferenceItemPermissionEnum implements GetLabelsInterface, GetRbacInheritanceInterface
{

    use CrudRbacInheritanceTrait;

    const CRUD = 'oReferenceItemCrud';
    const ALL = 'oReferenceItemAll';
    const ONE = 'oReferenceItemOne';
    const CREATE = 'oReferenceItemCreate';
    const UPDATE = 'oReferenceItemUpdate';
    const DELETE = 'oReferenceItemDelete';
    const RESTORE = 'oReferenceItemRestore';

    public static function getLabels()
    {
        return [
            self::CRUD => 'Значения справочника. Полный доступ',
            self::ALL => 'Значения справочника. Просмотр списка',
            self::ONE => 'Значения справочника. Просмотр записи',
            self::CREATE => 'Значения справочника. Создание',
            self::UPDATE => 'Значения справочника. Редактирование',
            self::DELETE => 'Значения справочника. Удаление',
            self::RESTORE => 'Значения справочника. Восстановление',
        ];
    }

}
