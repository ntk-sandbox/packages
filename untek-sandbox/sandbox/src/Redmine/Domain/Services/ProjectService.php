<?php

namespace Untek\Sandbox\Sandbox\Redmine\Domain\Services;

use Untek\Sandbox\Sandbox\Redmine\Domain\Interfaces\Services\ProjectServiceInterface;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Sandbox\Sandbox\Redmine\Domain\Interfaces\Repositories\ProjectRepositoryInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Sandbox\Sandbox\Redmine\Domain\Entities\ProjectEntity;

/**
 * @method ProjectRepositoryInterface getRepository()
 */
class ProjectService extends BaseCrudService implements ProjectServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return ProjectEntity::class;
    }


}

