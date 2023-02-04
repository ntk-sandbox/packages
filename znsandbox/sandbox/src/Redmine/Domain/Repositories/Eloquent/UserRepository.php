<?php

namespace Untek\Sandbox\Sandbox\Redmine\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Sandbox\Sandbox\Redmine\Domain\Entities\UserEntity;
use Untek\Sandbox\Sandbox\Redmine\Domain\Interfaces\Repositories\UserRepositoryInterface;

class UserRepository extends BaseEloquentCrudRepository implements UserRepositoryInterface
{

    public function tableName() : string
    {
        return 'redmine_user';
    }

    public function getEntityClass() : string
    {
        return UserEntity::class;
    }


}

