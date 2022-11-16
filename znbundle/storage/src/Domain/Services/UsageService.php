<?php

namespace ZnBundle\Storage\Domain\Services;

use ZnBundle\Storage\Domain\Entities\UsageEntity;
use ZnBundle\Storage\Domain\Interfaces\Repositories\UsageRepositoryInterface;
use ZnBundle\Storage\Domain\Interfaces\Services\UsageServiceInterface;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;

class UsageService extends BaseCrudService implements UsageServiceInterface
{

    private $authService;

    public function __construct(
        EntityManagerInterface $em,
        UsageRepositoryInterface $repository,
        AuthServiceInterface $authService
    )
    {
        $this->setEntityManager($em);
//        $this->setRepository($repository);
        $this->authService = $authService;
    }

    public function getEntityClass(): string
    {
        return UsageEntity::class;
    }

    public function add(int $serviceId, int $entityId, int $fileId)
    {
        $usageEntity = new UsageEntity();
        $usageEntity->setServiceId($serviceId);
        $usageEntity->setEntityId($entityId);
        $usageEntity->setFileId($fileId);

        if(!$this->authService->isGuest()) {
            $usageEntity->setUserId($this->authService->getIdentity()->getId());
        }

        $this->getEntityManager()->persist($usageEntity);
    }
}
