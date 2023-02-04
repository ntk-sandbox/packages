<?php

namespace Untek\Bundle\Article\Domain\Repositories\Eloquent;

use Untek\Bundle\Article\Domain\Entities\CategoryEntity;
use Untek\Bundle\Article\Domain\Interfaces\CategoryRepositoryInterface;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class CategoryRepository extends BaseEloquentCrudRepository implements CategoryRepositoryInterface
{

    protected $tableName = 'article_category';

    public function getEntityClass(): string
    {
        return CategoryEntity::class;
    }

}