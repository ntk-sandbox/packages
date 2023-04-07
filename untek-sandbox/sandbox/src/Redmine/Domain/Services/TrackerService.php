<?php

namespace Untek\Sandbox\Sandbox\Redmine\Domain\Services;

use Untek\Sandbox\Sandbox\Redmine\Domain\Interfaces\Services\TrackerServiceInterface;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Sandbox\Sandbox\Redmine\Domain\Interfaces\Repositories\TrackerRepositoryInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Sandbox\Sandbox\Redmine\Domain\Entities\TrackerEntity;

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

