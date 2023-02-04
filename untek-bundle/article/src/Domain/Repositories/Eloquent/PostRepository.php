<?php

namespace Untek\Bundle\Article\Domain\Repositories\Eloquent;

use Untek\Bundle\Article\Domain\Entities\PostEntity;
use Untek\Bundle\Article\Domain\Interfaces\CategoryRepositoryInterface;
use Untek\Bundle\Article\Domain\Interfaces\PostRepositoryInterface;
use Untek\Bundle\Article\Domain\Interfaces\TagPostRepositoryInterface;
use Untek\Bundle\Article\Domain\Interfaces\TagRepositoryInterface;
use Untek\Bundle\Article\Domain\Repositories\Relations\PostRelation;
use Untek\Domain\Repository\Interfaces\RelationConfigInterface;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Database\Eloquent\Domain\Capsule\Manager;

class PostRepository extends BaseEloquentCrudRepository implements PostRepositoryInterface
{

    protected $tableName = 'article_post';
    private $relation;

    public function __construct(Manager $capsule, PostRelation $postRelation)
    {
        parent::__construct($capsule);
        $this->relation = $postRelation;
    }

    public function getEntityClass(): string
    {
        return PostEntity::class;
    }

    /*public function relations()
    {
        return $this->relation->relations();
    }*/

}