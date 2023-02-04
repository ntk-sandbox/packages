<?php

namespace Untek\Database\Eloquent\Domain\Base;

use Illuminate\Database\QueryException;
use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Query\Enums\OperatorEnum;
use Untek\Domain\QueryFilter\Interfaces\ForgeQueryByFilterInterface;
use Untek\Domain\QueryFilter\Traits\ForgeQueryFilterTrait;
use Untek\Domain\QueryFilter\Traits\QueryFilterTrait;
use Untek\Domain\Repository\Interfaces\CrudRepositoryInterface;
use Untek\Domain\Repository\Interfaces\FindOneUniqueInterface;
use Untek\Domain\Repository\Traits\CrudRepositoryDeleteTrait;
use Untek\Domain\Repository\Traits\CrudRepositoryFindAllTrait;
use Untek\Domain\Repository\Traits\CrudRepositoryFindOneTrait;
use Untek\Domain\Repository\Traits\CrudRepositoryInsertTrait;
use Untek\Domain\Repository\Traits\CrudRepositoryUpdateTrait;
use Untek\Domain\Repository\Traits\RepositoryRelationTrait;
use Untek\Domain\Entity\Helpers\EntityHelper;
use Untek\Core\Text\Helpers\Inflector;
use Untek\Core\Text\Helpers\TextHelper;
use Untek\Domain\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Domain\Validator\Helpers\ValidationHelper;
use Untek\Database\Eloquent\Domain\Helpers\QueryBuilder\EloquentQueryBuilderHelper;

abstract class BaseEloquentCrudRepository extends BaseEloquentRepository implements CrudRepositoryInterface, ForgeQueryByFilterInterface, FindOneUniqueInterface
{

    use CrudRepositoryFindOneTrait;
    use CrudRepositoryFindAllTrait;
    use CrudRepositoryInsertTrait;
    use CrudRepositoryUpdateTrait;
    use CrudRepositoryDeleteTrait;
    use RepositoryRelationTrait;
    use ForgeQueryFilterTrait;

    /*public function primaryKey()
    {
        return $this->primaryKey;
    }*/

    public function count(Query $query = null): int
    {
        $query = $this->forgeQuery($query);
        $queryBuilder = $this->getQueryBuilder();
        $this->forgeQueryBuilder($queryBuilder, $query);
        return $queryBuilder->count();
    }

    protected function insertRaw($entity): void
    {
        $arraySnakeCase = $this->mapperEncodeEntity($entity);
        try {
            $lastId = $this->getQueryBuilder()->insertGetId($arraySnakeCase);
            $entity->setId($lastId);
        } catch (QueryException $e) {
            $errors = new UnprocessibleEntityException;
            $this->checkExists($entity);
            if (getenv('APP_DEBUG')) {
                $message = $e->getMessage();
                $message = TextHelper::removeDoubleSpace($message);
                $message = str_replace("'", "\\'", $message);
                $message = trim($message);
            } else {
                $message = 'Database error!';
            }
            $errors->add('', $message);
            throw $errors;
        }
    }

    public function createCollection(Enumerable $collection)
    {
        $array = [];
        foreach ($collection as $entity) {
            ValidationHelper::validateEntity($entity);
            $columnList = $this->getColumnsForModify();
            $array[] = EntityHelper::toArrayForTablize($entity, $columnList);
        }
//        $this->getQueryBuilder()->insert($array);
        $this->getQueryBuilder()->insertOrIgnore($array);
    }

    protected function getColumnsForModify()
    {
        $columnList = $this->getSchema()->getColumnListing($this->tableNameAlias());
        if (empty($columnList)) {
            $columnList = EntityHelper::getAttributeNames($this->getEntityClass());
            foreach ($columnList as &$item) {
                $item = Inflector::underscore($item);
            }
        }
        if (in_array('id', $columnList)) {
            ArrayHelper::removeByValue('id', $columnList);
        }
        return $columnList;
    }

    protected function allBySql(string $sql, array $binds = [])
    {
        return $this->getConnection()
            ->createCommand($sql, $binds)
            ->queryAll(\PDO::FETCH_CLASS);
    }

    private function updateQuery($id, array $data): void
    {
        $columnList = $this->getColumnsForModify();
        $data = ArrayHelper::extractByKeys($data, $columnList);
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->find($id);
        $queryBuilder->update($data);
    }

    protected function deleteByIdQuery($id): void
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($id);
    }

    public function updateByQuery(Query $query, array $values)
    {
        $query = $this->forgeQuery($query);
        $queryBuilder = $this->getQueryBuilder();
        $query->select([$queryBuilder->from . '.*']);
        EloquentQueryBuilderHelper::setWhere($query, $queryBuilder);
        EloquentQueryBuilderHelper::setJoin($query, $queryBuilder);
        EloquentQueryBuilderHelper::setSelect($query, $queryBuilder);
        EloquentQueryBuilderHelper::setOrder($query, $queryBuilder);
        EloquentQueryBuilderHelper::setGroupBy($query, $queryBuilder);
        EloquentQueryBuilderHelper::setPaginate($query, $queryBuilder);
        $queryBuilder->update($values);
    }

    public function deleteByCondition(array $condition)
    {
        $queryBuilder = $this->getQueryBuilder();
        foreach ($condition as $key => $value) {
            $queryBuilder->where($key, OperatorEnum::EQUAL, $value);
        }
        $queryBuilder->delete();
    }
}
