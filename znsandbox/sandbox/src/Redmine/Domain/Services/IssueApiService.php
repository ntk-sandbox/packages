<?php

namespace Untek\Sandbox\Sandbox\Redmine\Domain\Services;

use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Sandbox\Sandbox\Redmine\Domain\Entities\IssueApiEntity;
use Untek\Sandbox\Sandbox\Redmine\Domain\Interfaces\Repositories\IssueApiRepositoryInterface;
use Untek\Sandbox\Sandbox\Redmine\Domain\Interfaces\Services\IssueApiServiceInterface;

/**
 * @method IssueApiRepositoryInterface getRepository()
 */
class IssueApiService extends BaseCrudService implements IssueApiServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass(): string
    {
        return IssueApiEntity::class;
    }
}
