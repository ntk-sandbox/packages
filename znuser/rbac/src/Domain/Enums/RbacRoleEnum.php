<?php

namespace Untek\User\Rbac\Domain\Enums;

use Untek\Core\Code\Helpers\DeprecateHelper;
use Untek\Core\Enum\Interfaces\GetLabelsInterface;
use Untek\Core\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;
use Untek\User\Rbac\Domain\Enums\Rbac\SystemRoleEnum;

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
