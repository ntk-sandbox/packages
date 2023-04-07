<?php

namespace Untek\Framework\Rpc\Domain\Base;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Model\Query\Entities\Query;
use Untek\Model\QueryFilter\Interfaces\ForgeQueryByFilterInterface;
use Untek\Model\QueryFilter\Traits\ForgeQueryFilterTrait;
use Untek\Model\QueryFilter\Traits\QueryFilterTrait;
use Untek\Model\Repository\Interfaces\CrudRepositoryInterface;
use Untek\Model\Repository\Interfaces\FindOneUniqueInterface;
use Untek\Model\Repository\Traits\CrudRepositoryDeleteTrait;
use Untek\Model\Repository\Traits\CrudRepositoryFindAllTrait;
use Untek\Model\Repository\Traits\CrudRepositoryFindOneTrait;
use Untek\Model\Repository\Traits\CrudRepositoryInsertTrait;
use Untek\Model\Repository\Traits\CrudRepositoryUpdateTrait;
use Untek\Model\Repository\Traits\RepositoryRelationTrait;
use Untek\Model\Entity\Interfaces\EntityIdInterface;
use Untek\Framework\Rpc\Domain\Helpers\RpcQueryHelper;

abstract class BaseRpcCrudRepository extends BaseRpcRepository implements CrudRepositoryInterface, ForgeQueryByFilterInterface, FindOneUniqueInterface
{

    use CrudRepositoryFindOneTrait;
    use CrudRepositoryFindAllTrait;
    use CrudRepositoryInsertTrait;
    use CrudRepositoryUpdateTrait;
    use CrudRepositoryDeleteTrait;
    use RepositoryRelationTrait;
    use ForgeQueryFilterTrait;

    abstract public function methodPrefix(): string;

    public function count(Query $query = null): int
    {
        $query = $this->forgeQuery($query);
        $requestEntity = $this->createRequest('all');
        $params = RpcQueryHelper::query2RpcParams($query);
        $requestEntity->setParams($params);
        $responseEntity = $this->sendRequestByEntity($requestEntity);
        return $responseEntity->getMetaItem('totalCount');
    }

    protected function findBy(Query $query = null): Enumerable
    {
        $requestEntity = $this->createRequest('all');
        $params = RpcQueryHelper::query2RpcParams($query);
        $requestEntity->setParams($params);
        $responseEntity = $this->sendRequestByEntity($requestEntity);
        $collection = $this->mapperDecodeCollection($responseEntity->getResult() ?: []);

        /*$collection = $this
            ->getEntityManager()
            ->createEntityCollection($this->getEntityClass(), $responseEntity->getResult() ?: []);*/
        return $collection;
    }

    public function findOneById($id, Query $query = null): EntityIdInterface
    {
        $requestEntity = $this->createRequest('oneById');
        $params = RpcQueryHelper::query2RpcParams($query);
        $params['id'] = $id;
        $requestEntity->setParams($params);
        $responseEntity = $this->sendRequestByEntity($requestEntity);
        $entity = $this->mapperDecodeEntity($responseEntity->getResult() ?: []);

        /*$entity = $this
            ->getEntityManager()
            ->createEntity($this->getEntityClass(), $responseEntity->getResult() ?: []);*/
        return $entity;
    }

    /*public function findOneByUnique(UniqueInterface $entity): EntityIdInterface
    {
        // TODO: Implement findOneByUnique() method.
    }*/

    /*public function create(EntityIdInterface $entity)
    {
        // TODO: Implement create() method.
    }*/

    public function deleteByCondition(array $condition)
    {
        // TODO: Implement deleteByCondition() method.
    }

    protected function deleteByIdQuery($id): void
    {
        // TODO: Implement deleteByIdQuery() method.
    }

    protected function updateQuery($id, array $data): void
    {
        // TODO: Implement updateQuery() method.
    }

    protected function insertRaw($entity): void
    {
        // TODO: Implement insertRaw() method.
    }
}
