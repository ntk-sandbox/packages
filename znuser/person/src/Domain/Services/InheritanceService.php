<?php

namespace Untek\User\Person\Domain\Services;

use Untek\User\Person\Domain\Interfaces\Services\InheritanceServiceInterface;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\User\Person\Domain\Interfaces\Repositories\InheritanceRepositoryInterface;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\User\Person\Domain\Entities\InheritanceEntity;

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

