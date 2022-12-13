<?php

namespace ZnUser\Authentication\Domain\Repositories\Eloquent;

use ZnUser\Authentication\Domain\Entities\TokenEntity;
use ZnUser\Authentication\Domain\Interfaces\Repositories\TokenRepositoryInterface;
use ZnDomain\Query\Entities\Query;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class TokenRepository extends BaseEloquentCrudRepository implements TokenRepositoryInterface
{

    public function tableName(): string
    {
        return 'user_token';
    }

    public function getEntityClass(): string
    {
        return TokenEntity::class;
    }

    public function findOneByValue(string $value, string $type): TokenEntity
    {
        $query = new Query;
        $query->whereByConditions([
            'value' => $value,
            'type' => $type,
        ]);
        return $this->findOne($query);
    }
}
