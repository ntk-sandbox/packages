<?php

namespace Untek\Bundle\Storage\Domain\Enums\Rbac;

use Untek\Core\Enum\Interfaces\GetLabelsInterface;
use Untek\Core\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;
use Untek\Core\Contract\Rbac\Traits\CrudRbacInheritanceTrait;
use Untek\User\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

class StorageFilePermissionEnum implements GetLabelsInterface, GetRbacInheritanceInterface
{

    use CrudRbacInheritanceTrait;

    const CRUD = 'oStorageFileCrud';
    const ALL = 'oStorageFileAll';
    const ONE = 'oStorageFileOne';
    const CREATE = 'oStorageFileCreate';
    const UPDATE = 'oStorageFileUpdate';
    const DELETE = 'oStorageFileDelete';
    const RESTORE = 'oStorageFileRestore';

    public static function getLabels()
    {
        return [
            self::CRUD => 'Файлы. Полный доступ',
            self::ALL => 'Файлы. Просмотр списка',
            self::ONE => 'Файлы. Просмотр записи',
            self::CREATE => 'Файлы. Загрузка файла',
            self::UPDATE => 'Файлы. Редактирование',
            self::DELETE => 'Файлы. Удаление',
            self::RESTORE => 'Файлы. Восстановление',
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
            SystemRoleEnum::GUEST => [
                self::CREATE,
            ]
        ];
    }
}
