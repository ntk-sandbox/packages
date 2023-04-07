<?php

namespace Untek\Sandbox\Sandbox\Redmine\Domain\Services;

use Untek\Sandbox\Sandbox\Redmine\Domain\Interfaces\Services\IssueServiceInterface;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Sandbox\Sandbox\Redmine\Domain\Interfaces\Repositories\IssueRepositoryInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Sandbox\Sandbox\Redmine\Domain\Entities\IssueEntity;

/**
 * @method IssueRepositoryInterface getRepository()
 */
class IssueService extends BaseCrudService implements IssueServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return IssueEntity::class;
    }


}

