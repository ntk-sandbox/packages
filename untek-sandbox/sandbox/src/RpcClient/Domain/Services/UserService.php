<?php

namespace Untek\Sandbox\Sandbox\RpcClient\Domain\Services;

use Untek\Sandbox\Sandbox\RpcClient\Domain\Interfaces\Services\UserServiceInterface;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Sandbox\Sandbox\RpcClient\Domain\Interfaces\Repositories\UserRepositoryInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Sandbox\Sandbox\RpcClient\Domain\Entities\UserEntity;

/**
 * @method
 * UserRepositoryInterface getRepository()
 */
class UserService extends BaseCrudService implements UserServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return UserEntity::class;
    }


}

