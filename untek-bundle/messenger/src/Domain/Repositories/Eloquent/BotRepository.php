<?php

namespace Untek\Bundle\Messenger\Domain\Repositories\Eloquent;

use Untek\Bundle\Messenger\Domain\Entities\BotEntity;
use Untek\Bundle\Messenger\Domain\Interfaces\Repositories\BotRepositoryInterface;
use Untek\Domain\Domain\Enums\RelationEnum;
use Untek\Domain\Query\Entities\Query;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class BotRepository extends BaseEloquentCrudRepository implements BotRepositoryInterface
{

    protected $tableName = 'messenger_bot';

    public function getEntityClass(): string
    {
        return BotEntity::class;
    }

    public function findOneByUserId(int $userId): BotEntity
    {
        $query = new Query;
        $query->where('user_id', $userId);
        /** @var BotEntity $botEntity */
        return $this->findOne($query);
    }
}