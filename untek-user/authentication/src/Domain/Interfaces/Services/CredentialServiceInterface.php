<?php

namespace Untek\User\Authentication\Domain\Interfaces\Services;

use Untek\User\Authentication\Domain\Entities\CredentialEntity;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;

interface CredentialServiceInterface
{
    /**
     * @param int $identityId
     * @param string $type
     * @return CredentialEntity
     * @throws NotFoundException
     */
    public function findOneByIdentityIdAndType(int $identityId, string $type): CredentialEntity;

    /**
     * @param string $credential
     * @return CredentialEntity
     * @throws NotFoundException
     */
    public function findOneByCredentialValue(string $credential): CredentialEntity;

    public function hasByCredentialValue(string $credential): bool;
}

