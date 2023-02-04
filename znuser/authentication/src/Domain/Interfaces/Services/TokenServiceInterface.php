<?php

namespace Untek\User\Authentication\Domain\Interfaces\Services;

use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Core\Contract\User\Interfaces\Entities\IdentityEntityInterface;
use Untek\User\Authentication\Domain\Entities\TokenValueEntity;

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
