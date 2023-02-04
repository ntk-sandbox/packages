<?php

namespace Untek\Sandbox\Sandbox\Bundle\Domain\Services;

use Untek\Sandbox\Sandbox\Bundle\Domain\Interfaces\Services\DomainServiceInterface;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Sandbox\Sandbox\Bundle\Domain\Interfaces\Repositories\DomainRepositoryInterface;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Sandbox\Sandbox\Bundle\Domain\Entities\DomainEntity;

/**
 * @method
 * DomainRepositoryInterface getRepository()
 */
class DomainService extends BaseCrudService implements DomainServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return DomainEntity::class;
    }


}

