<?php

namespace Untek\Sandbox\Sandbox\Debug\Domain\Services;

use Untek\Sandbox\Sandbox\Debug\Domain\Interfaces\Services\ProfilingServiceInterface;
use Untek\Sandbox\Sandbox\Debug\Domain\Interfaces\Repositories\ProfilingRepositoryInterface;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Sandbox\Sandbox\Debug\Domain\Entities\ProfilingEntity;

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
