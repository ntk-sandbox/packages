<?php

namespace Untek\Bundle\TalkBox\Domain\Services;

use Untek\Bundle\TalkBox\Domain\Entities\AnswerEntity;
use Untek\Bundle\TalkBox\Domain\Helpers\WordHelper;
use Untek\Core\Container\Traits\ContainerAwareTrait;
use Untek\Core\Text\Helpers\TextHelper;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Core\Collection\Helpers\CollectionHelper;
use Untek\Framework\Telegram\Domain\Helpers\MatchHelper;

class PredictService
{

    use ContainerAwareTrait;

    public function textToSentences(string $text): array
    {
        $sentences = WordHelper::textToSentences($text);
        $map = [];
        foreach ($sentences as $sentence) {
            try {
                $map[] = $this->textToWords($sentence);
            } catch (NotFoundException $e) {
            }
        }
        return $map;
    }

    public function textToWords(string $text): array
    {
        $text = MatchHelper::prepareString($text);
        $words = TextHelper::getWordArray($text);
//        $container = Container::getInstance();
        $container = $this->getContainer();
        $tagService = $container->get(TagService::class);
        $words = $tagService->normalizeWorlds($words);
        return $words;
    }

    public function predictText(string $request): string
    {
        $request = MatchHelper::prepareString($request);
        $words = TextHelper::getWordArray($request);
        $answerText = $this->predict($words);
        return $answerText;
    }

    public function predict(array $words): string
    {
//        $container = Container::getInstance();
        $container = $this->getContainer();
        /** @var TagService $tagService */
        $tagService = $container->get(TagService::class);
        $words = $tagService->normalizeWorlds($words);

        // todo: replace char `ё` to `е`
        $answerTextArray = $this->answersByWords($words);
        if (empty($answerTextArray)) {
            throw new NotFoundException('predict');
        }
        $count = count($answerTextArray);
        $index = mt_rand(0, $count - 1);
        return $answerTextArray[$index];
    }

    private function findEqual(Enumerable $answerCollection, array $words): AnswerEntity
    {
        foreach ($answerCollection as $answerEntity) {
            $text = MatchHelper::prepareString($answerEntity->getRequestText());
            $tags = TextHelper::getWordArray($text);
            if (count($tags) == count($words)) {
                $isEqual = empty(array_diff($tags, $words));
                if ($isEqual) {
                    return $answerEntity;
                }
            }
        }
        throw new NotFoundException('findEqual');
    }

    private function answerIdsByWords(array $words): array
    {
//        $container = Container::getInstance();
        $container = $this->getContainer();
        $tagService = $container->get(TagService::class);
        $tagCollection = $tagService->allByWorlds($words);
        if ($tagCollection->count() < count($words)) {
            throw new NotFoundException('answerIdsByWords');
        }
        $tagIds = CollectionHelper::getColumn($tagCollection, 'id');
        $answerTagService = $container->get(AnswerTagService::class);
        $answerIds = $answerTagService->answerIdsByTagIds($tagIds);
        return $answerIds;
    }

    private function allOptionsByAnswerIds(array $answerIds, array $words): Enumerable
    {
//        $container = Container::getInstance();
        $container = $this->getContainer();
        $answerService = $container->get(AnswerService::class);
        $answerOptionService = $container->get(AnswerOptionService::class);
        /** @var Enumerable $answerCollection */
        $answerCollection = $answerService->allByIds($answerIds);
        $wordEntity = $this->findEqual($answerCollection, $words);
        if (empty($wordEntity)) {
            throw new NotFoundException('allOptionsByAnswerIds');
        }
        $optionCollection = $answerOptionService->allByAnswerIds([$wordEntity->getId()]);
        return $optionCollection;
    }

    private function answersByWords(array $words): array
    {
        $answerIds = $this->answerIdsByWords($words);
        if (count($answerIds) > 1000) {
            return [];
        }
        $optionCollection = $this->allOptionsByAnswerIds($answerIds, $words);
        $answerTextArray = CollectionHelper::getColumn($optionCollection, 'text');

        // dd($words);
        return $answerTextArray;
    }

}
