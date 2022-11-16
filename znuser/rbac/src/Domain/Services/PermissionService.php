<?php

namespace ZnUser\Rbac\Domain\Services;

use ZnUser\Rbac\Domain\Interfaces\Services\PermissionServiceInterface;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnUser\Rbac\Domain\Interfaces\Repositories\PermissionRepositoryInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnUser\Rbac\Domain\Entities\PermissionEntity;

/**
 * @method PermissionRepositoryInterface getRepository()
 */
class PermissionService extends BaseCrudService implements PermissionServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return PermissionEntity::class;
    }


}

