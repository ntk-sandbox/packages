<?php

namespace Untek\Bundle\Eav\Domain\Repositories\Eloquent;

use Untek\Bundle\Eav\Domain\Entities\ValidationEntity;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\ValidationRepositoryInterface;
use Untek\Domain\Query\Entities\Query;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

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
