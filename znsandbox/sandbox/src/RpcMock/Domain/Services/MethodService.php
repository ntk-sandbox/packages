<?php

namespace ZnSandbox\Sandbox\RpcMock\Domain\Services;

use ZnSandbox\Sandbox\RpcMock\Domain\Interfaces\Services\MethodServiceInterface;
use ZnSandbox\Sandbox\RpcMock\Domain\Interfaces\Repositories\MethodRepositoryInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnSandbox\Sandbox\RpcMock\Domain\Entities\MethodEntity;

/**
 * @method
 * MethodRepositoryInterface getRepository()
 */
class MethodService extends BaseCrudService implements MethodServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return MethodEntity::class;
    }


}

