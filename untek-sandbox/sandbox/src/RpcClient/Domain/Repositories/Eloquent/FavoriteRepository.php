<?php

namespace Untek\Sandbox\Sandbox\RpcClient\Domain\Repositories\Eloquent;

use Untek\Domain\Relation\Libs\Types\OneToOneRelation;
use Untek\Domain\Repository\Mappers\JsonMapper;
use Untek\Domain\Repository\Mappers\TimeMapper;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Sandbox\Sandbox\RpcClient\Domain\Entities\FavoriteEntity;
use Untek\Sandbox\Sandbox\RpcClient\Domain\Interfaces\Repositories\FavoriteRepositoryInterface;
use Untek\Sandbox\Sandbox\RpcClient\Domain\Interfaces\Repositories\UserRepositoryInterface;

class FavoriteRepository extends BaseEloquentCrudRepository implements FavoriteRepositoryInterface
{

    public function tableName(): string
    {
        return 'rpc_client_favorite';
    }

    public function getEntityClass(): string
    {
        return FavoriteEntity::class;
    }

    public function mappers(): array
    {
        return [
            new JsonMapper([
                'body',
                'meta',
            ]),
            new TimeMapper(['createdAt', 'updatedAt']),
        ];
    }

    public function relations()
    {
        return [
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'auth_by',
                'relationEntityAttribute' => 'auth',
                'foreignRepositoryClass' => UserRepositoryInterface::class
            ],
        ];
    }
}
