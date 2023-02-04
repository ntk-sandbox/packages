<?php

namespace Untek\Bundle\Messenger\Domain\Repositories\Eloquent;

use Untek\Bundle\Messenger\Domain\Entities\MessageEntity;
use Untek\Bundle\Messenger\Domain\Interfaces\ChatRepositoryInterface;
use Untek\Bundle\Messenger\Domain\Interfaces\Repositories\MessageRepositoryInterface;
use Untek\Domain\Domain\Enums\RelationEnum;
use Untek\Domain\Relation\Libs\Types\OneToOneRelation;
use Untek\Domain\Repository\Mappers\TimeMapper;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\User\Identity\Domain\Interfaces\Repositories\IdentityRepositoryInterface;

class MessageRepository extends BaseEloquentCrudRepository implements MessageRepositoryInterface
{

    protected $tableName = 'messenger_message';
    private $messageRelation;

    public function getEntityClass(): string
    {
        return MessageEntity::class;
    }

    public function mappers(): array
    {
        return [
            new TimeMapper(['created_at']),
        ];
    }

    public function relations()
    {
        return [
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'chat_id',
                'relationEntityAttribute' => 'chat',
                'foreignRepositoryClass' => ChatRepositoryInterface::class,
            ],
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'author_id',
                'relationEntityAttribute' => 'author',
                'foreignRepositoryClass' => IdentityRepositoryInterface::class,
            ],
        ];
    }
}