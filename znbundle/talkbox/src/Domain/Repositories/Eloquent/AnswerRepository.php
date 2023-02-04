<?php

namespace Untek\Bundle\TalkBox\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Bundle\TalkBox\Domain\Entities\AnswerEntity;
use Untek\Bundle\TalkBox\Domain\Interfaces\Repositories\AnswerRepositoryInterface;

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

