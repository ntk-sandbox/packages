<?php

namespace Untek\User\Rbac\Domain\Services;

use Untek\User\Rbac\Domain\Interfaces\Services\PermissionServiceInterface;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\User\Rbac\Domain\Interfaces\Repositories\PermissionRepositoryInterface;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\User\Rbac\Domain\Entities\PermissionEntity;

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

