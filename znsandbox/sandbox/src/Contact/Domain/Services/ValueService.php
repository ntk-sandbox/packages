<?php

namespace Untek\Sandbox\Sandbox\Contact\Domain\Services;

use Untek\Sandbox\Sandbox\Contact\Domain\Interfaces\Services\ValueServiceInterface;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Sandbox\Sandbox\Contact\Domain\Interfaces\Repositories\ValueRepositoryInterface;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Sandbox\Sandbox\Contact\Domain\Entities\ValueEntity;

/**
 * @method ValueRepositoryInterface getRepository()
 */
class ValueService extends BaseCrudService implements ValueServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return ValueEntity::class;
    }
}
