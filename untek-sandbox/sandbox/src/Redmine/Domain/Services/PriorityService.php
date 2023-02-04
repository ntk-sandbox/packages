<?php

namespace Untek\Sandbox\Sandbox\Redmine\Domain\Services;

use Untek\Sandbox\Sandbox\Redmine\Domain\Interfaces\Services\PriorityServiceInterface;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Sandbox\Sandbox\Redmine\Domain\Interfaces\Repositories\PriorityRepositoryInterface;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Sandbox\Sandbox\Redmine\Domain\Entities\PriorityEntity;

/**
 * @method PriorityRepositoryInterface getRepository()
 */
class PriorityService extends BaseCrudService implements PriorityServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return PriorityEntity::class;
    }


}

