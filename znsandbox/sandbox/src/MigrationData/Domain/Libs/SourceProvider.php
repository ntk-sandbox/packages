<?php

namespace ZnSandbox\Sandbox\MigrationData\Domain\Libs;

use ZnCore\Collection\Interfaces\Enumerable;
use ZnCore\EventDispatcher\Traits\EventDispatcherTrait;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Query\Entities\Query;
use ZnDomain\EntityManager\Traits\EntityManagerAwareTrait;

class SourceProvider
{

    use EntityManagerAwareTrait;
    use EventDispatcherTrait;

    private $query;
    private $limit = 500;
    private $page = 1;
    private $entityClass;

    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->setEntityManager($em);
        $this->resetPage();
    }

    public function getQuery(): Query
    {
        if ($this->query === null) {
            $this->query = Query::forge();
        }
        return $this->query;
    }

    public function setQuery(Query $query): void
    {
        $this->query = $query;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function resetPage(): void
    {
        $this->page = 1;
    }

    public function getEntityClass(): string
    {
        return $this->entityClass;
    }

    public function setEntityClass(string $entityClass): void
    {
        $this->entityClass = $entityClass;
    }

    public function getCollectionByPage(int $page): Enumerable
    {
        $entityClass = $this->getEntityClass();
        $query = $this->getQuery();
        $query->page($page);
        $query->perPage($this->getLimit());
        return $this->getEntityManager()->getRepository($entityClass)->findAll($query);
    }

    public function getNextCollection(): Enumerable
    {
        $page = $this->page;
        $collection = $this->getCollectionByPage($page);
        if ($collection->count()) {
            $this->page++;
        }
        return $collection;
    }

    public function getCount(): int
    {
        $entityClass = $this->getEntityClass();
        $query = $this->getQuery();
        return $this->getEntityManager()->getRepository($entityClass)->count($query);
    }
}
