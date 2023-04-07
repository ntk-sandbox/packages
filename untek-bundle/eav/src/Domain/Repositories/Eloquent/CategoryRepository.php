<?php

namespace Untek\Bundle\Eav\Domain\Repositories\Eloquent;

use Untek\Bundle\Eav\Domain\Entities\CategoryEntity;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\CategoryRepositoryInterface;
use Untek\Model\Query\Entities\Query;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class CategoryRepository extends BaseEloquentCrudRepository implements CategoryRepositoryInterface
{

    public function tableName(): string
    {
        return 'eav_category';
    }

    public function getEntityClass(): string
    {
        return CategoryEntity::class;
    }

    public function findOneByName(string $name, Query $query = null): CategoryEntity
    {
        $query = Query::forge($query);
        $query->where('name', $name);
        return $this->findOne($query);
    }
}
