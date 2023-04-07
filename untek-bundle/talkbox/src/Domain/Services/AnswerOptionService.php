<?php

namespace Untek\Bundle\TalkBox\Domain\Services;

use Untek\Bundle\TalkBox\Domain\Interfaces\Repositories\AnswerOptionRepositoryInterface;
use Untek\Bundle\TalkBox\Domain\Interfaces\Services\AnswerOptionServiceInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Model\Query\Entities\Query;

class AnswerOptionService extends BaseCrudService implements AnswerOptionServiceInterface
{

    public function __construct(AnswerOptionRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    public function allByAnswerIds(array $answerIds)
    {
        $query = new Query;
        $query->where('answer_id', $answerIds);
        $query->orderBy([
            'sort' => SORT_ASC,
        ]);
        return parent::findAll($query);
    }
}
