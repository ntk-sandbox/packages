<?php

namespace Untek\Bundle\Eav\Domain\Interfaces\Repositories;

use Untek\Bundle\Eav\Domain\Entities\ValueEntity;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Repository\Interfaces\CrudRepositoryInterface;

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
