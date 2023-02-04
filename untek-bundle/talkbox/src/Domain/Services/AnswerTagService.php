<?php

namespace Untek\Bundle\TalkBox\Domain\Services;

use Untek\Bundle\TalkBox\Domain\Interfaces\Repositories\AnswerTagRepositoryInterface;
use Untek\Bundle\TalkBox\Domain\Interfaces\Services\AnswerTagServiceInterface;
use Untek\Core\Collection\Helpers\CollectionHelper;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Domain\Entity\Helpers\EntityHelper;

class AnswerTagService extends BaseCrudService implements AnswerTagServiceInterface
{

    public function __construct(AnswerTagRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    public function answerIdsByTagIds(array $tagIds): array
    {
        $collection = $this->getRepository()->allByTagIds($tagIds);
        return CollectionHelper::getColumn($collection, 'answerId');
    }
}
