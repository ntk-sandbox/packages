<?php

namespace ZnBundle\Eav\Domain\Interfaces\Repositories;

use ZnBundle\Eav\Domain\Entities\ValueEntity;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnDomain\Query\Entities\Query;
use ZnDomain\Repository\Interfaces\CrudRepositoryInterface;

interface ValueRepositoryInterface extends CrudRepositoryInterface
{

    /**
     * @param int $entityId
     * @param int $recordId
     * @param Query|null $query
     * @return Enumerable | ValueEntity[]
     */
    public function allValues(int $entityId, int $recordId, Query $query = null): Enumerable;
}
