<?php

namespace ZnSandbox\Sandbox\Debug\Domain\Services;

use ZnSandbox\Sandbox\Debug\Domain\Interfaces\Services\ProfilingServiceInterface;
use ZnSandbox\Sandbox\Debug\Domain\Interfaces\Repositories\ProfilingRepositoryInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnSandbox\Sandbox\Debug\Domain\Entities\ProfilingEntity;

/**
 * @method
 * ProfilingRepositoryInterface getRepository()
 */
class ProfilingService extends BaseCrudService implements ProfilingServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return ProfilingEntity::class;
    }
}
