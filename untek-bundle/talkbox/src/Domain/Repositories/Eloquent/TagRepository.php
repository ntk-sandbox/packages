<?php

namespace Untek\Bundle\TalkBox\Domain\Repositories\Eloquent;

use Untek\Bundle\TalkBox\Domain\Entities\TagEntity;
use Untek\Bundle\TalkBox\Domain\Interfaces\Repositories\TagRepositoryInterface;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

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
