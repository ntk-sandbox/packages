<?php

namespace Untek\Bundle\Queue\Domain\Repositories\Eloquent;

use Untek\Bundle\Queue\Domain\Entities\JobEntity;
use Untek\Bundle\Queue\Domain\Interfaces\Repositories\JobRepositoryInterface;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class JobRepository extends BaseEloquentCrudRepository implements JobRepositoryInterface
{

    protected $tableName = 'queue_job';

    public function getEntityClass(): string
    {
        return JobEntity::class;
    }

    /*public function newTasks(string $channel = null): Enumerable
    {
        $query = new NewTaskQuery($channel);
        return $this->findAll($query);
    }*/
}
