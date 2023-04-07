<?php

namespace Untek\Bundle\Queue\Domain\Repositories\Eloquent;

use Untek\Bundle\Queue\Domain\Entities\ScheduleEntity;
use Untek\Bundle\Queue\Domain\Interfaces\Repositories\ScheduleRepositoryInterface;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Repository\Mappers\TimeMapper;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class ScheduleRepository extends BaseEloquentCrudRepository implements ScheduleRepositoryInterface
{

    public function tableName(): string
    {
        return 'queue_schedule';
    }

    public function getEntityClass(): string
    {
        return ScheduleEntity::class;
    }

    public function allByChannel(string $channel = null, Query $query = null): Enumerable
    {
        $query = $this->forgeQuery($query);
        if ($channel) {
            $query->where('channel', $channel);
        }
        return $this->findAll($query);
    }

    public function mappers(): array
    {
        return [
            new TimeMapper(['executed_at', 'created_at', 'updated_at']),
        ];
    }
}
