<?php

namespace ZnUser\Rbac\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;
use ZnCore\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;

class SystemRoleEnum implements GetLabelsInterface, GetRbacInheritanceInterface
{

    const GUEST = 'rGuest';
    const USER = 'rUser';
    const DEVELOPER = 'rDeveloper';
    const ADMINISTRATOR = 'rAdministrator';
    const ROOT = 'rRoot';

    public static function getLabels()
    {
        return [
            self::GUEST => 'Гость системы',
            self::USER => 'Идентифицированный пользователь',
            self::DEVELOPER => 'Разработчик',
            self::ADMINISTRATOR => 'Администратор системы',
            self::ROOT => 'Корневой администратор системы',
        ];
    }

    public static function getInheritance()
    {
        return [
            self::USER => [
                self::GUEST,
            ],
            self::DEVELOPER => [
                self::USER,
            ],
            self::ADMINISTRATOR => [
                self::USER,
            ],
            self::ROOT => [
                self::DEVELOPER,
                self::ADMINISTRATOR,
            ],
        ];
    }
}