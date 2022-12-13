<?php

namespace ZnBundle\TalkBox\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnBundle\TalkBox\Domain\Entities\AnswerEntity;
use ZnBundle\TalkBox\Domain\Interfaces\Repositories\AnswerRepositoryInterface;

class AnswerRepository extends BaseEloquentCrudRepository implements AnswerRepositoryInterface
{

    public function tableName() : string
    {
        return 'dialog_answer';
    }

    public function getEntityClass() : string
    {
        return AnswerEntity::class;
    }


}

