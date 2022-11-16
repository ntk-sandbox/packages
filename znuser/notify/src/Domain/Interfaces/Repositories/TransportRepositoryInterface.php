<?php

namespace ZnUser\Notify\Domain\Interfaces\Repositories;

use ZnCore\Collection\Interfaces\Enumerable;
use ZnDomain\Repository\Interfaces\CrudRepositoryInterface;
use ZnUser\Notify\Domain\Entities\TransportEntity;

interface TransportRepositoryInterface extends CrudRepositoryInterface
{

    /**
     * @param int $typeId
     * @return Enumerable|array|TransportEntity[]
     */
    public function allEnabledByTypeId(int $typeId): Enumerable;
}
