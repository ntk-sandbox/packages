<?php

namespace ZnBundle\TalkBox\Domain\Repositories\Eloquent;

use ZnBundle\TalkBox\Domain\Entities\TagEntity;
use ZnBundle\TalkBox\Domain\Interfaces\Repositories\TagRepositoryInterface;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class TagRepository extends BaseEloquentCrudRepository implements TagRepositoryInterface
{

    public function tableName(): string
    {
        return 'dialog_tag';
    }

    public function getEntityClass(): string
    {
        return TagEntity::class;
    }

    /*public function relations()
    {
        return [

        ];
    }*/

}
