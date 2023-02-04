<?php

namespace Untek\Bundle\Article\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Bundle\Article\Domain\Entities\PostTagEntity;
use Untek\Bundle\Article\Domain\Interfaces\TagPostRepositoryInterface;

class TagPostRepository extends BaseEloquentCrudRepository implements TagPostRepositoryInterface
{

    protected $tableName = 'article_tag_post';

    public function getEntityClass(): string
    {
        return PostTagEntity::class;
    }
}