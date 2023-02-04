<?php

namespace Untek\User\Rbac\Domain\Services;

use Untek\User\Rbac\Domain\Interfaces\Services\RoleServiceInterface;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Service\Base\BaseCrudService;
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

