<?php

namespace Untek\Bundle\Messenger\Domain\Repositories\Eloquent;

use Untek\Bundle\Messenger\Domain\Entities\FlowEntity;
use Untek\Bundle\Messenger\Domain\Interfaces\FlowRepositoryInterface;
use Untek\Bundle\Messenger\Domain\Interfaces\Repositories\MessageRepositoryInterface;
use Untek\Domain\Domain\Enums\RelationEnum;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Relation\Libs\Types\OneToOneRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class FlowRepository extends BaseEloquentCrudRepository implements FlowRepositoryInterface
{

    protected $tableName = 'messenger_flow';
    private $messageRepository;

    /*public function __construct(Manager $capsule, MessageRepositoryInterface $messageRepository)
    {
        parent::__construct($capsule);
        $this->messageRepository = $messageRepository;
    }*/

    public function getEntityClass(): string
    {
        return FlowEntity::class;
    }

    protected function forgeQuery(Query $query = null): Query
    {
        $query = parent::forgeQuery($query);
        $query->with('message');
        return $query;
    }

    public function relations()
    {
        return [
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'message_id',
                'relationEntityAttribute' => 'message',
                'foreignRepositoryClass' => MessageRepositoryInterface::class,
            ],
        ];
    }
}