<?php

namespace ZnSandbox\Sandbox\Redmine\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnSandbox\Sandbox\Redmine\Domain\Entities\UserEntity;
use ZnSandbox\Sandbox\Redmine\Domain\Interfaces\Repositories\UserRepositoryInterface;

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

