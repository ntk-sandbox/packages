<?php

namespace Untek\User\Registration\Domain\Enums\Rbac;

use Untek\Core\Enum\Interfaces\GetLabelsInterface;

class UserRegistrationPermissionEnum implements GetLabelsInterface
{

    const REQUEST_ACTIVATION_CODE = 'oRegistrationRequestActivationCode';
    const CREATE_ACCOUNT = 'oRegistrationCreateAccount';

    public static function getLabels()
    {
        return [
            self::REQUEST_ACTIVATION_CODE => 'Запросить код активации',
            self::CREATE_ACCOUNT => 'Создать аккаунт',
        ];
    }
}