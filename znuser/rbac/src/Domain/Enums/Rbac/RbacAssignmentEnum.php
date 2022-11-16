<?php

namespace ZnUser\Rbac\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;

class RbacAssignmentEnum implements GetLabelsInterface
{

    const ATTACH = 'oRbacAssignmentAttach';
    const DETACH = 'oRbacAssignmentDetach';
    const ALL_ROLES = 'oRbacAssignmentAllRoles';

    public static function getLabels()
    {
        return [
            self::ATTACH => 'RBAC назначения полномочий. Прикрепить полномочие',
            self::DETACH => 'RBAC назначения полномочий. Открепить полномочие',
            self::ALL_ROLES => 'RBAC назначения полномочий. Получить все роли пользователя',
        ];
    }
}