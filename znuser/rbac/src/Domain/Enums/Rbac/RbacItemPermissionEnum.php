<?php

namespace ZnUser\Rbac\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;
use ZnCore\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;
use ZnCore\Contract\Rbac\Traits\CrudRbacInheritanceTrait;

class RbacItemPermissionEnum implements GetLabelsInterface, GetRbacInheritanceInterface
{

    use CrudRbacInheritanceTrait;

    const CRUD = 'oRbacItemCrud';
    const ALL = 'oRbacItemAll';
    const ONE = 'oRbacItemOne';
    const CREATE = 'oRbacItemCreate';
    const UPDATE = 'oRbacItemUpdate';
    const DELETE = 'oRbacItemDelete';
//    const RESTORE = 'oRbacItemRestore';

    public static function getLabels()
    {
        return [
            self::CRUD => 'RBAC. Роли и полномочия. Полный доступ',
            self::ALL => 'RBAC. Роли и полномочия. Просмотр списка',
            self::ONE => 'RBAC. Роли и полномочия. Просмотр записи',
            self::CREATE => 'RBAC. Роли и полномочия. Создание',
            self::UPDATE => 'RBAC. Роли и полномочия. Редактирование',
            self::DELETE => 'RBAC. Роли и полномочия. Удаление',
//            self::RESTORE => 'RBAC. item. Восстановление',
        ];
    }
}