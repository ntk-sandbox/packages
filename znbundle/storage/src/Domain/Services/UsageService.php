<?php

namespace ZnBundle\Storage\Domain\Services;

use Symfony\Component\Security\Core\Security;
use ZnBundle\Storage\Domain\Entities\UsageEntity;
use ZnBundle\Storage\Domain\Interfaces\Repositories\UsageRepositoryInterface;
use ZnBundle\Storage\Domain\Interfaces\Services\UsageServiceInterface;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Service\Base\BaseCrudService;

class UsageService extends BaseCrudService implements UsageServiceInterface
{

//    use GetUserTrait;

//    private $authService;

    public function __construct(
        EntityManagerInterface $em,
        UsageRepositoryInterface $repository,
//        AuthServiceInterface $authService,
        private Security $security
    )
    {
        $this->setEntityManager($em);
//        $this->setRepository($repository);
//        $this->authService = $authService;
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

        $identityEntity = $this->security->getUser();
        if($identityEntity) {
            $usageEntity->setUserId($identityEntity->getId());
        }

        $this->getEntityManager()->persist($usageEntity);
    }
}
