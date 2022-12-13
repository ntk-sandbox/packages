<?php

namespace ZnBundle\Eav\Domain\Repositories\Eloquent;

use ZnBundle\Eav\Domain\Entities\ValidationEntity;
use ZnBundle\Eav\Domain\Interfaces\Repositories\ValidationRepositoryInterface;
use ZnDomain\Query\Entities\Query;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class ValidationRepository extends BaseEloquentCrudRepository implements ValidationRepositoryInterface
{

    public function tableName(): string
    {
        return 'eav_validation';
    }

    public function getEntityClass(): string
    {
        return ValidationEntity::class;
    }

    protected function forgeQuery(Query $query = null): Query
    {
        return parent::forgeQuery($query)->orderBy(['sort' => SORT_ASC]);
    }
}
