<?php

namespace Untek\User\Person\Domain\Services;

use Untek\Bundle\Reference\Domain\Entities\ItemEntity;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\User\Person\Domain\Entities\SexEntity;
use Untek\User\Person\Domain\Interfaces\Repositories\SexRepositoryInterface;
use Untek\User\Person\Domain\Interfaces\Services\SexServiceInterface;

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
