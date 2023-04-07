<?php

namespace Untek\User\Rbac\Domain\Services;

use Untek\User\Rbac\Domain\Interfaces\Services\RoleServiceInterface;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\User\Rbac\Domain\Entities\RoleEntity;

class RoleService extends BaseCrudService implements RoleServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return RoleEntity::class;
    }
}

