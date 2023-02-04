<?php

namespace Untek\Bundle\TalkBox\Domain\Repositories\Eloquent;

use Untek\Bundle\TalkBox\Domain\Entities\AnswerOptionEntity;
use Untek\Bundle\TalkBox\Domain\Interfaces\Repositories\AnswerOptionRepositoryInterface;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

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

