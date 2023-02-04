<?php

namespace Untek\Bundle\Queue\Domain\Interfaces\Services;

use Untek\Bundle\Queue\Domain\Entities\JobEntity;
use Untek\Bundle\Queue\Domain\Entities\ScheduleEntity;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Service\Interfaces\CrudServiceInterface;

interface ScheduleServiceInterface extends CrudServiceInterface
{

    /**
     * @param string|null $channel
     * @return Enumerable | JobEntity[]
     */
    public function runAll(string $channel = null): Enumerable;

    /**
     * @param Query|null $query
     * @return Enumerable | ScheduleEntity[]
     */
    public function allByChannel(string $channel = null, Query $query = null): Enumerable;
}
