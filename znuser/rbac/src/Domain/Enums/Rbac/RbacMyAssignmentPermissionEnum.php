<?php

namespace Untek\User\Rbac\Domain\Enums\Rbac;

use Untek\Core\Enum\Interfaces\GetLabelsInterface;
use Untek\Core\Contract\Rbac\Interfaces\GetRbacInheritanceInterface;

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