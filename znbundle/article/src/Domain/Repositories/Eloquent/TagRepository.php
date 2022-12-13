<?php

namespace ZnBundle\Article\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnBundle\Article\Domain\Entities\TagEntity;
use ZnBundle\Article\Domain\Interfaces\TagRepositoryInterface;

class TagRepository extends BaseEloquentCrudRepository implements TagRepositoryInterface
{

    protected $tableName = 'article_tag';

    public function getEntityClass(): string
    {
        return TagEntity::class;
    }
}