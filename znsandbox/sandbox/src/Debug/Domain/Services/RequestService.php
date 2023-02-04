<?php

namespace Untek\Sandbox\Sandbox\Debug\Domain\Services;

use Untek\Sandbox\Sandbox\Debug\Domain\Interfaces\Services\RequestServiceInterface;
use Untek\Sandbox\Sandbox\Debug\Domain\Interfaces\Repositories\RequestRepositoryInterface;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Sandbox\Sandbox\Debug\Domain\Entities\RequestEntity;

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
