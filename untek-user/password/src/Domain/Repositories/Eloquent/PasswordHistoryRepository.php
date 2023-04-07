<?php

namespace Untek\User\Password\Domain\Repositories\Eloquent;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Model\Query\Entities\Query;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\User\Password\Domain\Entities\PasswordHistoryEntity;
use Untek\User\Password\Domain\Interfaces\Repositories\PasswordHistoryRepositoryInterface;

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
