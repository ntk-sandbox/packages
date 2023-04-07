<?php

namespace Untek\Sandbox\Sandbox\Person2\Domain\Services;

use Untek\Bundle\Reference\Domain\Entities\ItemEntity;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Sandbox\Sandbox\Person2\Domain\Entities\SexEntity;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Repositories\SexRepositoryInterface;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Services\SexServiceInterface;

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
