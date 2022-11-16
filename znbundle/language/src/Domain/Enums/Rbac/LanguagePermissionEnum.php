<?php

namespace ZnBundle\Language\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;
use ZnCore\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;
use ZnCore\Contract\Rbac\Traits\CrudRbacInheritanceTrait;

class LanguagePermissionEnum implements GetLabelsInterface, GetRbacInheritanceInterface
{

    use CrudRbacInheritanceTrait;

    const CRUD = 'oLanguageLanguageCrud';
    const ALL = 'oLanguageLanguageAll';
    const ONE = 'oLanguageLanguageOne';
    const CREATE = 'oLanguageLanguageCreate';
    const UPDATE = 'oLanguageLanguageUpdate';
    const DELETE = 'oLanguageLanguageDelete';
    const RESTORE = 'oLanguageLanguageRestore';
    const ALL_HIDDEN = 'oLanguageLanguageAllHidden';

    public static function getLabels()
    {
        return [
            self::CRUD => 'Язык. Полный доступ',
            self::ALL => 'Язык. Просмотр списка',
            self::ONE => 'Язык. Просмотр записи',
            self::CREATE => 'Язык. Создание',
            self::UPDATE => 'Язык. Редактирование',
            self::DELETE => 'Язык. Удаление',
            self::RESTORE => 'Язык. Восстановление',
            self::ALL_HIDDEN => 'Язык. Просмотр скрытых продуктов',
        ];
    }
}
