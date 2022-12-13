<?php

namespace ZnUser\Password\Domain\Repositories\Eloquent;

use ZnCore\Collection\Interfaces\Enumerable;
use ZnDomain\Query\Entities\Query;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnUser\Password\Domain\Entities\PasswordHistoryEntity;
use ZnUser\Password\Domain\Interfaces\Repositories\PasswordHistoryRepositoryInterface;

class PasswordHistoryRepository extends BaseEloquentCrudRepository implements PasswordHistoryRepositoryInterface
{

    public function tableName(): string
    {
        return 'security_password_history';
    }

    public function getEntityClass(): string
    {
        return PasswordHistoryEntity::class;
    }

    public function allByIdentityId(int $identityId): Enumerable
    {
        $query = new Query();
        $query->where('identity_id', $identityId);
        return $this->findAll($query);
    }
}
