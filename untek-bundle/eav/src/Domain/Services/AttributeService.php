<?php

namespace Untek\Bundle\Eav\Domain\Services;

use Untek\Bundle\Eav\Domain\Interfaces\Repositories\AttributeRepositoryInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Services\AttributeServiceInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;

class AttributeService extends BaseCrudService implements AttributeServiceInterface
{

    public function __construct(
        AttributeRepositoryInterface $repository,
        EntityManagerInterface $entityManager
    )
    {
        $this->setRepository($repository);
        $this->setEntityManager($entityManager);
    }
}
