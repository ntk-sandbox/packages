<?php

namespace Untek\User\Notify\Domain\Repositories\Eloquent;

use Untek\User\Notify\Domain\Entities\NotifyEntity;
use Untek\User\Notify\Domain\Interfaces\Repositories\HistoryRepositoryInterface;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class HistoryRepository extends BaseEloquentCrudRepository implements HistoryRepositoryInterface
{

    public function tableName(): string
    {
        return 'notify_history';
    }

    public function getEntityClass(): string
    {
        return NotifyEntity::class;
    }

    /*public function send(NotifyEntity $notifyEntity) {
        ValidationHelper::validateEntity($notifyEntity);

    }*/
}
