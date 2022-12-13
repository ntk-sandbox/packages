<?php

namespace ZnUser\Person\Domain\Services;

use ZnUser\Person\Domain\Interfaces\Services\InheritanceServiceInterface;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnUser\Person\Domain\Interfaces\Repositories\InheritanceRepositoryInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnUser\Person\Domain\Entities\InheritanceEntity;

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

