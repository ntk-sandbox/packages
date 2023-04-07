<?php

namespace Untek\Sandbox\Sandbox\Person\Domain\Services;

use Untek\Sandbox\Sandbox\Person\Domain\Interfaces\Services\InheritanceServiceInterface;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Sandbox\Sandbox\Person\Domain\Interfaces\Repositories\InheritanceRepositoryInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Sandbox\Sandbox\Person\Domain\Entities\InheritanceEntity;

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

