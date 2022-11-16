<?php

namespace ZnUser\Password\Domain\Interfaces\Repositories;

use ZnCore\Collection\Interfaces\Enumerable;
use ZnDomain\Repository\Interfaces\CrudRepositoryInterface;
use ZnUser\Password\Domain\Entities\PasswordHistoryEntity;

interface PasswordHistoryRepositoryInterface extends CrudRepositoryInterface
{

    /**
     * @param int $identityId
     * @return Enumerable | PasswordHistoryEntity[]
     */
    public function allByIdentityId(int $identityId): Enumerable;
}

