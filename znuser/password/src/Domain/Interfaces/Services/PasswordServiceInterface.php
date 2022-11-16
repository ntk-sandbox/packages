<?php

namespace ZnUser\Password\Domain\Interfaces\Services;

use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;

interface PasswordServiceInterface
{

    /**
     * Установить новый пароль
     * @param string $newPassword
     * @param int|null $identityId
     * @throws UnprocessibleEntityException
     */
    public function setPassword(string $newPassword, int $identityId = null);
}
