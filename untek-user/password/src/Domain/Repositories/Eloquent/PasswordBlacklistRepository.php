<?php

namespace Untek\User\Password\Domain\Repositories\Eloquent;

use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Model\Query\Entities\Query;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\User\Password\Domain\Entities\PasswordBlacklistEntity;
use Untek\User\Password\Domain\Interfaces\Repositories\PasswordBlacklistRepositoryInterface;

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
