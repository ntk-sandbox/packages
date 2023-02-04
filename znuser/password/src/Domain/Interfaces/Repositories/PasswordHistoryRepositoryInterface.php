<?php

namespace Untek\User\Password\Domain\Interfaces\Repositories;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Domain\Repository\Interfaces\CrudRepositoryInterface;
use Untek\User\Password\Domain\Entities\PasswordHistoryEntity;

interface PasswordHistoryRepositoryInterface extends CrudRepositoryInterface
{

    /**
     * @param int $identityId
     * @return Enumerable | PasswordHistoryEntity[]
     */
    public function allByIdentityId(int $identityId): Enumerable;
}

