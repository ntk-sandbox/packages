<?php

namespace ZnUser\Rbac\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;
use ZnCore\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;

class RbacMyAssignmentPermissionEnum implements GetLabelsInterface, GetRbacInheritanceInterface
{

    const ALL = 'oRbacMyAssignmentAll';

    public static function getLabels()
    {
        return [
            self::ALL => 'Мои роли. Просмотр списка',
        ];
    }

    public static function getInheritance()
    {
        return [
            SystemRoleEnum::USER => [
                self::ALL
            ],
        ];
    }
}