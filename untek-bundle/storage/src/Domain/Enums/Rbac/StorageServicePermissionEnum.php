<?php

namespace Untek\Bundle\Storage\Domain\Enums\Rbac;

use Untek\Core\Enum\Interfaces\GetLabelsInterface;
use Untek\Core\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;
use Untek\Core\Contract\Rbac\Traits\CrudRbacInheritanceTrait;

class StorageServicePermissionEnum implements GetLabelsInterface, GetRbacInheritanceInterface
{

    use CrudRbacInheritanceTrait;

    const CRUD = 'oStorageServiceCrud';
    const ALL = 'oStorageServiceAll';
    const ONE = 'oStorageServiceOne';
    const CREATE = 'oStorageServiceCreate';
    const UPDATE = 'oStorageServiceUpdate';
    const DELETE = 'oStorageServiceDelete';
    const RESTORE = 'oStorageServiceRestore';

    public static function getLabels()
    {
        return [
            self::CRUD => 'Сервис файлохранилища. Полный доступ',
            self::ALL => 'Сервис файлохранилища. Просмотр списка',
            self::ONE => 'Сервис файлохранилища. Просмотр записи',
            self::CREATE => 'Сервис файлохранилища. Создание',
            self::UPDATE => 'Сервис файлохранилища. Редактирование',
            self::DELETE => 'Сервис файлохранилища. Удаление',
            self::RESTORE => 'Сервис файлохранилища. Восстановление',
        ];
    }
}
