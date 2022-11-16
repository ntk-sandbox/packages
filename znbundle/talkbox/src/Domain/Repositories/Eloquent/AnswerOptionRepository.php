<?php

namespace ZnBundle\TalkBox\Domain\Repositories\Eloquent;

use ZnBundle\TalkBox\Domain\Entities\AnswerOptionEntity;
use ZnBundle\TalkBox\Domain\Interfaces\Repositories\AnswerOptionRepositoryInterface;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class AnswerOptionRepository extends BaseEloquentCrudRepository implements AnswerOptionRepositoryInterface
{

    public function tableName(): string
    {
        return 'dialog_answer_option';
    }

    public function getEntityClass(): string
    {
        return AnswerOptionEntity::class;
    }


}

