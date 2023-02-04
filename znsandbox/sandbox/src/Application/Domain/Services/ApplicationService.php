<?php

namespace Untek\Sandbox\Sandbox\Application\Domain\Services;

use Untek\Sandbox\Sandbox\Application\Domain\Interfaces\Services\ApplicationServiceInterface;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Sandbox\Sandbox\Application\Domain\Interfaces\Repositories\ApplicationRepositoryInterface;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Sandbox\Sandbox\Application\Domain\Entities\ApplicationEntity;

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

