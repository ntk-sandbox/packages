<?php

namespace ZnSandbox\Sandbox\Redmine\Domain\Mappers;

use ZnDomain\Repository\Interfaces\MapperInterface;
use ZnSandbox\Sandbox\Redmine\Domain\Entities\PriorityEntity;
use ZnSandbox\Sandbox\Redmine\Domain\Entities\ProjectEntity;
use ZnSandbox\Sandbox\Redmine\Domain\Entities\StatusEntity;
use ZnSandbox\Sandbox\Redmine\Domain\Entities\TrackerEntity;
use ZnSandbox\Sandbox\Redmine\Domain\Entities\UserEntity;

class IssueApiMapper implements MapperInterface
{

    public function encode($entityAttributes)
    {
        return $entityAttributes;
    }

    public function decode($rowAttributes)
    {
        if (!empty($rowAttributes['project'])) {
            $projectEntity = new ProjectEntity();
            $projectEntity->setId($rowAttributes['project']['id']);
            $projectEntity->setName($rowAttributes['project']['name']);
            $rowAttributes['project'] = $projectEntity;
        }

        if (!empty($rowAttributes['tracker'])) {
            $projectEntity = new TrackerEntity();
            $projectEntity->setId($rowAttributes['tracker']['id']);
            $projectEntity->setName($rowAttributes['tracker']['name']);
            $rowAttributes['tracker'] = $projectEntity;
        }

        if (!empty($rowAttributes['status'])) {
            $projectEntity = new StatusEntity();
            $projectEntity->setId($rowAttributes['status']['id']);
            $projectEntity->setName($rowAttributes['status']['name']);
            $rowAttributes['status'] = $projectEntity;
        }

        if (!empty($rowAttributes['priority'])) {
            $projectEntity = new PriorityEntity();
            $projectEntity->setId($rowAttributes['priority']['id']);
            $projectEntity->setName($rowAttributes['priority']['name']);
            $rowAttributes['priority'] = $projectEntity;
        }

        if (!empty($rowAttributes['author'])) {
            $projectEntity = new UserEntity();
            $projectEntity->setId($rowAttributes['author']['id']);
            $projectEntity->setName($rowAttributes['author']['name']);
            $rowAttributes['author'] = $projectEntity;
        }

        if (!empty($rowAttributes['assigned_to'])) {
            $projectEntity = new UserEntity();
            $projectEntity->setId($rowAttributes['assigned_to']['id']);
            $projectEntity->setName($rowAttributes['assigned_to']['name']);
            $rowAttributes['assigned'] = $projectEntity;
        }

        return $rowAttributes;
    }
}
