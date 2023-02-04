<?php

namespace Untek\Domain\EntityManager\Interfaces;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;
use Untek\Domain\Repository\Interfaces\FindOneUniqueInterface;
use Untek\Domain\Repository\Interfaces\RepositoryInterface;

interface EntityManagerInterface extends TransactionInterface, FindOneUniqueInterface
{

    public function getRepository(string $entityClass): RepositoryInterface;

    public function loadEntityRelations(object $entityOrCollection, array $with): void;

    public function remove(EntityIdInterface $entity): void;

    public function persist(EntityIdInterface $entity): void;

    public function insert(EntityIdInterface $entity): void;

    public function update(EntityIdInterface $entity): void;

    public function createEntity(string $entityClassName, array $attributes = []): object;

    public function createEntityCollection(string $entityClassName, array $items): Enumerable;

}
