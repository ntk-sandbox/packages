<?php

namespace Untek\Bundle\Eav\Domain\Repositories\Eloquent;

use Untek\Bundle\Eav\Domain\Entities\EnumEntity;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\EnumRepositoryInterface;
use Untek\Model\Query\Entities\Query;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class EnumRepository extends BaseEloquentCrudRepository implements EnumRepositoryInterface
{

    public function tableName(): string
    {
        return 'eav_enum';
    }

    public function getEntityClass(): string
    {
        return EnumEntity::class;
    }

    protected function forgeQuery(Query $query = null): Query
    {
        return parent::forgeQuery($query)->orderBy(['sort' => SORT_ASC]);
    }
}

