<?php

namespace ZnUser\Notify\Domain\Repositories\Eloquent;

use ZnUser\Notify\Domain\Entities\NotifyEntity;
use ZnUser\Notify\Domain\Interfaces\Repositories\HistoryRepositoryInterface;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;

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
