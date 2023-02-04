<?php

namespace Untek\Bundle\TalkBox\Domain\Repositories\Eloquent;

use Untek\Bundle\TalkBox\Domain\Entities\AnswerTagEntity;
use Untek\Bundle\TalkBox\Domain\Interfaces\Repositories\AnswerTagRepositoryInterface;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Core\Collection\Helpers\CollectionHelper;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class AnswerTagRepository extends BaseEloquentCrudRepository implements AnswerTagRepositoryInterface
{

    public function tableName(): string
    {
        return 'dialog_answer_tag';
    }

    public function getEntityClass(): string
    {
        return AnswerTagEntity::class;
    }

    /* public function relations()
     {
         return [

         ];
     }*/

    public function allByTagIds(array $tagIds): Enumerable
    {
        $array = $this->getQueryBuilder()
            ->select(['answer_id'])
            ->whereIn('tag_id', $tagIds)
            ->groupBy(['answer_id'])
            ->havingRaw('COUNT(*) = ' . count($tagIds))
            ->get();
        $entityClass = $this->getEntityClass();
        $collection = CollectionHelper::create($entityClass, $array->toArray());
        return $collection;
    }

}
