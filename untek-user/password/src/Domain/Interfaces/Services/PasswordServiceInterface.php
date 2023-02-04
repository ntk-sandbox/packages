<?php

namespace Untek\User\Password\Domain\Interfaces\Services;

use Untek\Domain\Validator\Exceptions\UnprocessibleEntityException;

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
