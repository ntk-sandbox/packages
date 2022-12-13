<?php

namespace ZnUser\Authentication\Domain\Interfaces\Services;

use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnCore\Contract\User\Interfaces\Entities\IdentityEntityInterface;
use ZnUser\Authentication\Domain\Entities\TokenValueEntity;

interface TokenServiceInterface
{

    public function getTokenByIdentity(IdentityEntityInterface $identityEntity): TokenValueEntity;

    /**
     * @param string $token
     * @return int
     *
     * @throws NotFoundException
     */
    public function getIdentityIdByToken(string $token): int;
}
