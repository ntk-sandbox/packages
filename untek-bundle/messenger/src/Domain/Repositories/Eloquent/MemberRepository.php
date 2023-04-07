<?php

namespace Untek\Bundle\Messenger\Domain\Repositories\Eloquent;

use Untek\Bundle\Messenger\Domain\Entities\MemberEntity;
use Untek\Bundle\Messenger\Domain\Interfaces\MemberRepositoryInterface;
use Untek\Model\Shared\Enums\RelationEnum;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Relation\Libs\Types\OneToOneRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\User\Identity\Domain\Interfaces\Repositories\IdentityRepositoryInterface;

class MemberRepository extends BaseEloquentCrudRepository implements MemberRepositoryInterface
{

    protected $tableName = 'messenger_member';
    private $userRepository;

    public function getEntityClass(): string
    {
        return MemberEntity::class;
    }

    protected function forgeQuery(Query $query = null): Query
    {
        $query = parent::forgeQuery($query);
        $query->with('user');
        return $query;
    }

    public function relations()
    {
        return [
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'user_id',
                'relationEntityAttribute' => 'user',
                'foreignRepositoryClass' => IdentityRepositoryInterface::class,
            ],
        ];
    }
}