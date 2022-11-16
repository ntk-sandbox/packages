<?php

namespace ZnDomain\Service\Base;

use ZnDomain\Domain\Interfaces\GetEntityClassInterface;
use ZnDomain\EntityManager\Traits\EntityManagerAwareTrait;
use ZnCore\EventDispatcher\Traits\EventDispatcherTrait;
use ZnDomain\Repository\Traits\RepositoryAwareTrait;
use ZnDomain\Service\Interfaces\CreateEntityInterface;

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