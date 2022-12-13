<?php

namespace ZnUser\Person\Domain\Services;

use ZnBundle\Reference\Domain\Entities\ItemEntity;
use ZnDomain\Service\Base\BaseCrudService;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnUser\Person\Domain\Entities\SexEntity;
use ZnUser\Person\Domain\Interfaces\Repositories\SexRepositoryInterface;
use ZnUser\Person\Domain\Interfaces\Services\SexServiceInterface;

/**
 * @method SexRepositoryInterface getRepository()
 */
class SexService extends BaseCrudService implements SexServiceInterface
{

    public function __construct(EntityManagerInterface $em, SexRepositoryInterface $repository)
    {
        $this->setEntityManager($em);
        $this->setRepository($repository);
    }

    public function getEntityClass(): string
    {
        return ItemEntity::class;
    }
}
