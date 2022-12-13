<?php

namespace ZnUser\Password\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;

class SecurityPermissionEnum implements GetLabelsInterface
{

    const RESTORE_PASSWORD_REQUEST_ACTIVATION_CODE = 'oRestorePasswordRequestActivationCode';
    const RESTORE_PASSWORD_CREATE_PASSWORD = 'oRestorePasswordCreatePassword';
    const UPDATE_PASSWORD_UPDATE = 'oUpdatePasswordUpdate';
    const VALIDATE_PASSWORD_UPDATE = 'oValidatePasswordValidate';

    public static function getLabels()
    {
        return [
            self::RESTORE_PASSWORD_REQUEST_ACTIVATION_CODE => 'Восстановление пароля. Запроса кода активации',
            self::RESTORE_PASSWORD_CREATE_PASSWORD => 'Восстановление пароля. Создание пароля',
            self::UPDATE_PASSWORD_UPDATE => 'Изменение пароля',
            self::VALIDATE_PASSWORD_UPDATE => 'Валидация пароля',
        ];
    }
}