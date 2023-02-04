<?php

namespace Untek\Bundle\Article\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Bundle\Article\Domain\Entities\TagEntity;
use Untek\Bundle\Article\Domain\Interfaces\TagRepositoryInterface;

class TagRepository extends BaseEloquentCrudRepository implements TagRepositoryInterface
{

    protected $tableName = 'article_tag';

    public function getEntityClass(): string
    {
        return TagEntity::class;
    }
}