<?php

namespace ZnSandbox\Sandbox\Debug\Domain\Services;

use ZnSandbox\Sandbox\Debug\Domain\Interfaces\Services\RequestServiceInterface;
use ZnSandbox\Sandbox\Debug\Domain\Interfaces\Repositories\RequestRepositoryInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnSandbox\Sandbox\Debug\Domain\Entities\RequestEntity;

/**
 * @method
 * RequestRepositoryInterface getRepository()
 */
class RequestService extends BaseCrudService implements RequestServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return RequestEntity::class;
    }
}
