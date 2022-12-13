<?php

namespace ZnDomain\Components\ArrayRepository\Traits;

use ZnCore\Collection\Interfaces\Enumerable;
use ZnCore\Contract\Common\Exceptions\InvalidMethodParameterException;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Query\Entities\Query;
use ZnDomain\Domain\Traits\DispatchEventTrait;
use ZnDomain\Repository\Traits\CrudRepositoryFindAllTrait;
use ZnDomain\Repository\Traits\CrudRepositoryFindOneTrait;
use ZnDomain\Components\ArrayRepository\Helpers\FilterHelper;

trait ArrayCrudRepositoryTrait
{

    use CrudRepositoryFindAllTrait;
    use CrudRepositoryFindOneTrait;
    use DispatchEventTrait;

    abstract protected function getItems(): array;

    abstract protected function setItems(array $items);

    abstract protected function getEntityManager(): EntityManagerInterface;

    abstract protected function forgeQuery(Query $query = null): Query;

    public function findAll(Query $query = null): Enumerable
    {
        $items = $this->getItems();
        if ($query) {
            $items = FilterHelper::filterItems($items, $query);
        }
        $collection = $this->getEntityManager()->createEntityCollection($this->getEntityClass(), $items);
        if($query && $query->getWith()) {
            $this->getEntityManager()->loadEntityRelations($collection, $query->getWith());
        }
        return $collection;
    }

    public function count(Query $query = null): int
    {
        $collection = $this->findAll($query);
        return $collection->count();
    }

    public function findOneById($id, Query $query = null): EntityIdInterface
    {
        if (empty($id)) {
            throw (new InvalidMethodParameterException('Empty ID'))
                ->setParameterName('id');
        }
        $query = $this->forgeQuery($query);
        $query->where('id', $id);
        $query->limit(1);
        $collection = $this->findAll($query);
        return $collection->first();
    }

    /**
     * @param Query|null $query
     * @return EntityIdInterface
     * @throws NotFoundException
     */
//    public function one(Query $query = null): EntityIdInterface
//    {
//        $query = $this->forgeQuery($query);
//        $query->limit(1);
//        /** @var Collection $collection */
//        $collection = $this->findAll($query);
//        if ($collection->count() == 0) {
//            throw new NotFoundException();
//        }
//        return $collection->first();
//    }

//    public function findOne(Query $query = null): EntityIdInterface
//    {
//        $query = $this->forgeQuery($query);
//        $query->limit(1);
//        /** @var Collection $collection */
//        $collection = $this->findAll($query);
//        if ($collection->count() == 0) {
//            throw new NotFoundException();
//        }
//        return $collection->first();
//    }

    /*public function findOneByUnique(UniqueInterface $entity): EntityIdInterface
    {
        // TODO: Implement findOneByUnique() method.
    }*/

    public function create(EntityIdInterface $entity)
    {
        $items = $this->getItems();
        $items[] = EntityHelper::toArray($entity);
        $this->setItems($items);
    }

    public function update(EntityIdInterface $entity)
    {
        $items = $this->getItems();
        foreach ($items as &$item) {
            if ($entity->getId() == $item['id']) {
                $item = EntityHelper::toArray($entity);
            }
        }
        $this->setItems($items);
    }

    public function deleteById($id)
    {
        $this->deleteByCondition(['id' => $id]);
        /*$items = $this->getItems();
        foreach ($items as &$item) {
            if($entity->getId() == $item['id']) {
                unset($item);
            }
        }
        $this->setItems($items);*/
    }

    public function deleteByCondition(array $condition)
    {
        $items = $this->getItems();
        foreach ($items as &$item) {
            $isMatch = $this->isMatch($item, $condition);
            if ($isMatch) {
                unset($item);
            }
        }
        $this->setItems($items);
    }

    private function isMatch(array $item, array $condition): bool
    {
        foreach ($condition as $conditionAttribute => $conditionValue) {
            if ($item[$conditionAttribute] != $conditionValue) {
                return false;
            }
        }
        return true;
    }
}
