<?php

namespace Untek\Bundle\Summary\Domain\Interfaces\Repositories;

use Untek\Domain\Repository\Interfaces\CrudRepositoryInterface;

interface AttemptRepositoryInterface extends CrudRepositoryInterface
{

    /**
     * Получить количество попыток
     * @param int $identityId
     * @param string $action
     * @param int $lifeTime
     * @return int
     */
    public function countByIdentityId(int $identityId, string $action, int $lifeTime): int;
}

