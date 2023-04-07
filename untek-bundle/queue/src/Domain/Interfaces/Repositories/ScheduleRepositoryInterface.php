<?php

namespace Untek\Bundle\Queue\Domain\Interfaces\Repositories;

use Untek\Bundle\Queue\Domain\Entities\ScheduleEntity;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Repository\Interfaces\CrudRepositoryInterface;

interface ScheduleRepositoryInterface extends CrudRepositoryInterface
{

    /**
     * @param Query|null $query
     * @return Enumerable | ScheduleEntity[]
     */
    public function allByChannel(string $channel = null, Query $query = null): Enumerable;
}
