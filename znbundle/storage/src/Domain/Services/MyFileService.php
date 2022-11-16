<?php

namespace ZnBundle\Storage\Domain\Services;

use ZnBundle\Storage\Domain\Entities\FileEntity;
use ZnBundle\Storage\Domain\Interfaces\Repositories\MyFileRepositoryInterface;
use ZnBundle\Storage\Domain\Interfaces\Services\MyFileServiceInterface;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnDomain\Query\Entities\Join;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Query\Entities\Query;

class MyFileService extends BaseCrudService implements MyFileServiceInterface
{

    private $authService;

    public function __construct(EntityManagerInterface $em, AuthServiceInterface $authService)
    {
        $this->setEntityManager($em);
        $this->authService = $authService;
    }

    public function getEntityClass(): string
    {
        return FileEntity::class;
    }

    protected function forgeQuery(Query $query = null): Query
    {
        return parent::forgeQuery($query)
            ->joinNew(new Join('storage_file_usage', 'storage_file.id', 'storage_file_usage.file_id'))
            ->where('storage_file_usage.user_id', $this->authService->getIdentity()->getId());
    }
}
