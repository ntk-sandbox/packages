<?php

namespace ZnSandbox\Sandbox\Person2\Domain\Services;

use ZnSandbox\Sandbox\Person2\Domain\Interfaces\Services\InheritanceServiceInterface;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnSandbox\Sandbox\Person2\Domain\Interfaces\Repositories\InheritanceRepositoryInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnSandbox\Sandbox\Person2\Domain\Entities\InheritanceEntity;

/**
 * @method
 * InheritanceRepositoryInterface getRepository()
 */
class InheritanceService extends BaseCrudService implements InheritanceServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return InheritanceEntity::class;
    }


}

