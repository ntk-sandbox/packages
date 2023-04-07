<?php

namespace Untek\Sandbox\Sandbox\Application\Domain\Services;

use Untek\Sandbox\Sandbox\Application\Domain\Interfaces\Services\ApplicationServiceInterface;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Sandbox\Sandbox\Application\Domain\Interfaces\Repositories\ApplicationRepositoryInterface;
use Untek\Model\Service\Base\BaseCrudService;
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

