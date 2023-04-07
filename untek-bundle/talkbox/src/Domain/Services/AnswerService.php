<?php

namespace Untek\Bundle\TalkBox\Domain\Services;

use Untek\Bundle\TalkBox\Domain\Entities\AnswerEntity;
use Untek\Bundle\TalkBox\Domain\Interfaces\Repositories\AnswerRepositoryInterface;
use Untek\Bundle\TalkBox\Domain\Interfaces\Services\AnswerServiceInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Model\Query\Entities\Query;

class AnswerService extends BaseCrudService implements AnswerServiceInterface
{

    public function __construct(AnswerRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    public function findOneByRequestTextOrCreate(string $word): AnswerEntity
    {
        $query = new Query;
        $query->where('request_text', $word);
        $collection = $this->getRepository()->findAll($query);
        if ($collection->count() === 0) {
            $entity = $this->createEntity();
            $entity->setRequestText($word);
            $this->getRepository()->create($entity);
        } else {
            $entity = $collection->first();
        }
        return $entity;
    }

    public function allByIds(array $answerIds)
    {
        $query = new Query;
        $query->where('id', $answerIds);
        return parent::findAll($query);
    }

}
