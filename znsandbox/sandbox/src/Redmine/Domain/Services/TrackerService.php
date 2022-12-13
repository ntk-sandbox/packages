<?php

namespace ZnSandbox\Sandbox\Redmine\Domain\Services;

use ZnSandbox\Sandbox\Redmine\Domain\Interfaces\Services\TrackerServiceInterface;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnSandbox\Sandbox\Redmine\Domain\Interfaces\Repositories\TrackerRepositoryInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnSandbox\Sandbox\Redmine\Domain\Entities\TrackerEntity;

/**
 * @method TrackerRepositoryInterface getRepository()
 */
class TrackerService extends BaseCrudService implements TrackerServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return TrackerEntity::class;
    }


}

