<?php

namespace Untek\User\Notify\Domain\Interfaces\Repositories;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Model\Repository\Interfaces\CrudRepositoryInterface;
use Untek\User\Notify\Domain\Entities\TransportEntity;

interface TransportRepositoryInterface extends CrudRepositoryInterface
{

    /**
     * @param int $typeId
     * @return Enumerable|array|TransportEntity[]
     */
    public function allEnabledByTypeId(int $typeId): Enumerable;
}
