<?php

namespace ZnBundle\Article\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnBundle\Article\Domain\Entities\PostTagEntity;
use ZnBundle\Article\Domain\Interfaces\TagPostRepositoryInterface;

class TagPostRepository extends BaseEloquentCrudRepository implements TagPostRepositoryInterface
{

    protected $tableName = 'article_tag_post';

    public function getEntityClass(): string
    {
        return PostTagEntity::class;
    }
}