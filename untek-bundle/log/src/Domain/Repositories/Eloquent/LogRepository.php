<?php

namespace Untek\Bundle\Log\Domain\Repositories\Eloquent;

use Untek\Bundle\Log\Domain\Entities\LogEntity;
use Untek\Bundle\Log\Domain\Interfaces\Repositories\LogRepositoryInterface;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class LogRepository extends BaseEloquentCrudRepository implements LogRepositoryInterface
{

    public function tableName(): string
    {
        return 'log_history';
    }

    public function getEntityClass(): string
    {
        return LogEntity::class;
    }
}
