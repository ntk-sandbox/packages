<?php

namespace ZnBundle\TalkBox\Domain\Services;

use ZnBundle\TalkBox\Domain\Interfaces\Repositories\AnswerOptionRepositoryInterface;
use ZnBundle\TalkBox\Domain\Interfaces\Services\AnswerOptionServiceInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnDomain\Query\Entities\Query;

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
