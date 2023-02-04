<?php

namespace Untek\Domain\Service\Base;

use Untek\Domain\Domain\Interfaces\GetEntityClassInterface;
use Untek\Domain\EntityManager\Traits\EntityManagerAwareTrait;
use Untek\Core\EventDispatcher\Traits\EventDispatcherTrait;
use Untek\Domain\Repository\Traits\RepositoryAwareTrait;
use Untek\Domain\Service\Interfaces\CreateEntityInterface;

abstract class BaseService implements GetEntityClassInterface, CreateEntityInterface
{

    use EventDispatcherTrait;
    use EntityManagerAwareTrait;
    use RepositoryAwareTrait;

    public function getEntityClass(): string
    {
        return $this->getRepository()->getEntityClass();
    }

    public function createEntity(array $attributes = [])
    {
        $entityClass = $this->getEntityClass();
        return $this
            ->getEntityManager()
            ->createEntity($entityClass, $attributes);
    }
}