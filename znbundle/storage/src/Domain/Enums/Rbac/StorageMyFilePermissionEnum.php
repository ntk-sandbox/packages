<?php

namespace ZnBundle\Storage\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;
use ZnCore\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;
use ZnCore\Contract\Rbac\Traits\CrudRbacInheritanceTrait;
use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

class StorageMyFilePermissionEnum implements GetLabelsInterface, GetRbacInheritanceInterface
{

    use CrudRbacInheritanceTrait;

    const CRUD = 'oStorageMyFileCrud';
    const ALL = 'oStorageMyFileAll';
    const ONE = 'oStorageMyFileOne';
    const CREATE = 'oStorageMyFileCreate';
    const UPDATE = 'oStorageMyFileUpdate';
    const DELETE = 'oStorageMyFileDelete';
    const RESTORE = 'oStorageMyFileRestore';

    public static function getLabels()
    {
        return [
            self::CRUD => 'Мои файлы. Полный доступ',
            self::ALL => 'Мои файлы. Просмотр списка',
            self::ONE => 'Мои файлы. Просмотр записи',
            self::CREATE => 'Мои файлы. Загрузка файла',
            self::UPDATE => 'Мои файлы. Редактирование',
            self::DELETE => 'Мои файлы. Удаление',
            self::RESTORE => 'Мои файлы. Восстановление',
        ];
    }

    public static function getInheritance()
    {
        return [
            self::CRUD => [
                self::ALL,
                self::ONE,
                self::CREATE,
                self::UPDATE,
                self::DELETE,
//                self::RESTORE,
            ],
            SystemRoleEnum::USER => [
                self::CRUD,
            ]
        ];
    }
}
