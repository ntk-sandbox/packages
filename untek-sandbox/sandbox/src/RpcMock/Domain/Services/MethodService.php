<?php

namespace Untek\Sandbox\Sandbox\RpcMock\Domain\Services;

use Untek\Sandbox\Sandbox\RpcMock\Domain\Interfaces\Services\MethodServiceInterface;
use Untek\Sandbox\Sandbox\RpcMock\Domain\Interfaces\Repositories\MethodRepositoryInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Sandbox\Sandbox\RpcMock\Domain\Entities\MethodEntity;

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

