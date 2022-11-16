<?php

namespace ZnSandbox\Sandbox\Redmine\Domain\Repositories\Api;

use Redmine\Api\AbstractApi;
use ZnDomain\Repository\Mappers\PathMapper;
use ZnDomain\Repository\Mappers\TimeMapper;
use ZnSandbox\Sandbox\Redmine\Domain\Entities\IssueApiEntity;
use ZnSandbox\Sandbox\Redmine\Domain\Interfaces\Repositories\IssueApiRepositoryInterface;
use ZnSandbox\Sandbox\Redmine\Domain\Mappers\IssueApiMapper;

class IssueApiRepository extends BaseApiRepository implements IssueApiRepositoryInterface
{

    public function getEntityClass(): string
    {
        return IssueApiEntity::class;
    }

    public function getEndpoint(): AbstractApi
    {
        return $this->getClient()->issue;
    }

    public function mappers(): array
    {
        return [
            new PathMapper([
                'projectId' => 'project.id',
                'trackerId' => 'tracker.id',
                'statusId' => 'status.id',
                'priorityId' => 'priority.id',
                'authorId' => 'author.id',
                'assignedId' => 'assigned_to.id',
                'createdAt' => 'created_on',
                'updatedAt' => 'updated_on',
            ], false),
            new TimeMapper(['createdAt', 'updatedAt']),
            new IssueApiMapper(),
        ];
    }
}
