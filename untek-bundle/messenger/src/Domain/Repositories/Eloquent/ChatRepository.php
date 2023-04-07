<?php

namespace Untek\Bundle\Messenger\Domain\Repositories\Eloquent;

use Untek\Bundle\Messenger\Domain\Entities\ChatEntity;
use Untek\Bundle\Messenger\Domain\Interfaces\ChatRepositoryInterface;
use Untek\Bundle\Messenger\Domain\Interfaces\MemberRepositoryInterface;
use Untek\Model\Shared\Enums\RelationEnum;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Relation\Libs\Types\OneToManyRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class ChatRepository extends BaseEloquentCrudRepository implements ChatRepositoryInterface
{

    protected $tableName = 'messenger_chat';
    private $flowRepository;
    private $memberRepository;
    //private $security;

//    public function __construct(
//        Manager $capsule,
//        /*FlowRepositoryInterface $flowRepository,*/
//        MemberRepositoryInterface $memberRepository
//        //Security $security
//    )
//    {
//        parent::__construct($capsule);
//        //$this->flowRepository = $flowRepository;
//        $this->memberRepository = $memberRepository;
//        //$this->security = $security;
//    }

    public function getEntityClass(): string
    {
        return ChatEntity::class;
    }

    public function findOneByIdWithMembers($id, Query $query = null): ChatEntity
    {
        $query = $this->forgeQuery($query);
        $query->with('members.user');
        return parent::findOneById($id, $query);
    }

    /*public function _all(Query $query = null)
    {
        $collection = parent::_all($query);
        foreach ($collection as $entity) {
            $entity->setSecurity($this->security);
        }
        return $collection;
    }*/

    public function relations()
    {
        return [
            [
                'class' => OneToManyRelation::class,
                'relationAttribute' => 'id',
                'relationEntityAttribute' => 'members',
                'foreignRepositoryClass' => MemberRepositoryInterface::class,
                'foreignAttribute' => 'chat_id',
            ],
        ];
    }
}