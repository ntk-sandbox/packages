<?php

namespace ZnUser\Rbac\Domain\Enums;

use ZnCore\Code\Helpers\DeprecateHelper;
use ZnCore\Enum\Interfaces\GetLabelsInterface;
use ZnCore\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;
use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

DeprecateHelper::hardThrow();

class RbacRoleEnum implements GetLabelsInterface, GetRbacInheritanceInterface
{

    const AUTHORIZED = '@';
    const GUEST = '?';

    public static function getLabels()
    {
        return [
            self::AUTHORIZED => 'Авторизованный',
            self::GUEST => 'Гость',
        ];
    }

    public static function getInheritance()
    {
        return [
            self::AUTHORIZED => [
                SystemRoleEnum::GUEST,
            ],
            SystemRoleEnum::USER => [
                self::AUTHORIZED,
            ],
        ];
    }
}
