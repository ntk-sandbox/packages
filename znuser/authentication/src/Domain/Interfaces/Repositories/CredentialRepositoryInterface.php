<?php

namespace ZnUser\Authentication\Domain\Interfaces\Repositories;

use ZnCore\Collection\Interfaces\Enumerable;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnDomain\Repository\Interfaces\CrudRepositoryInterface;
use ZnUser\Authentication\Domain\Entities\CredentialEntity;
use ZnUser\Authentication\Domain\Enums\CredentialTypeEnum;

interface CredentialRepositoryInterface extends CrudRepositoryInterface
{

    /**
     * @param int $identityId
     * @param array|null $types
     * @return Enumerable | CredentialEntity[]
     */
    public function allByIdentityId(int $identityId, array $types = null): Enumerable;

    /**
     * @param string $credential
     * @param string $type
     * @return CredentialEntity
     * @throws NotFoundException
     */
    public function findOneByCredential(string $credential, string $type = CredentialTypeEnum::LOGIN): CredentialEntity;

    public function findOneByCredentialValue(string $credential): CredentialEntity;

    /**
     * @param string $validation
     * @param string $type
     * @return CredentialEntity
     * @throws NotFoundException
     */
    public function findOneByValidation(string $validation, string $type): CredentialEntity;
}

