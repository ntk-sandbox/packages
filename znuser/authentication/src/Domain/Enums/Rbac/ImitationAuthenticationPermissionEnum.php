<?php

namespace ZnUser\Authentication\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;

class ImitationAuthenticationPermissionEnum implements GetLabelsInterface
{

    public const IMITATION = 'oUserImitationImitation';

    public static function getLabels()
    {
        return [
            self::IMITATION => 'Пользователь. Имитация аутентификации',
        ];
    }
}
