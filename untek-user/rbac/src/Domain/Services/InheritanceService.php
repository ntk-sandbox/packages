<?php

namespace Untek\User\Rbac\Domain\Services;

use Untek\User\Rbac\Domain\Interfaces\Services\InheritanceServiceInterface;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\User\Rbac\Domain\Entities\InheritanceEntity;

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

