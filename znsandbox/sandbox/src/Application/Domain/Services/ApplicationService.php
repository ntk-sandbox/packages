<?php

namespace ZnSandbox\Sandbox\Application\Domain\Services;

use ZnSandbox\Sandbox\Application\Domain\Interfaces\Services\ApplicationServiceInterface;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnSandbox\Sandbox\Application\Domain\Interfaces\Repositories\ApplicationRepositoryInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnSandbox\Sandbox\Application\Domain\Entities\ApplicationEntity;

/**
 * @method
 * ApplicationRepositoryInterface getRepository()
 */
class ApplicationService extends BaseCrudService implements ApplicationServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return ApplicationEntity::class;
    }


}

