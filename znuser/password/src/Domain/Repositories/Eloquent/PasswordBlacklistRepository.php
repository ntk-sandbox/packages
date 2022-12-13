<?php

namespace ZnUser\Password\Domain\Repositories\Eloquent;

use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnDomain\Query\Entities\Query;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnUser\Password\Domain\Entities\PasswordBlacklistEntity;
use ZnUser\Password\Domain\Interfaces\Repositories\PasswordBlacklistRepositoryInterface;

class PasswordBlacklistRepository extends BaseEloquentCrudRepository implements PasswordBlacklistRepositoryInterface
{

    public function tableName() : string
    {
        return 'security_password_blacklist';
    }

    public function getEntityClass() : string
    {
        return PasswordBlacklistEntity::class;
    }

    public function isHas(string $password) : bool
    {
        $query = new Query();
        $query->where('password', $password);
        try {
            $this->findOne($query);
            return true;
        } catch (NotFoundException $e) {
            return false;
        }
    }
}
