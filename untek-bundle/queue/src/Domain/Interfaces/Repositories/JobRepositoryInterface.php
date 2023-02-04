<?php

namespace Untek\Bundle\Queue\Domain\Interfaces\Repositories;

use Untek\Bundle\Queue\Domain\Entities\JobEntity;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Repository\Interfaces\CrudRepositoryInterface;

interface JobRepositoryInterface extends CrudRepositoryInterface
{

    /**
     * Выбрать невыполненные и зависшие задачи
     * @param Query|null $query
     * @return JobEntity[]
     */
    //public function newTasks(string $channel = null): Enumerable;
}