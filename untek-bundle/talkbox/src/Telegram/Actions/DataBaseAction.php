<?php

namespace Untek\Bundle\TalkBox\Telegram\Actions;

use Untek\Core\Container\Libs\Container;
use Untek\Bundle\TalkBox\Domain\Helpers\WordHelper;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;

use Untek\Core\Container\Helpers\ContainerHelper;
use Untek\Core\Text\Helpers\TextHelper;
use Untek\Framework\Telegram\Domain\Base\BaseAction;
use Untek\Framework\Telegram\Domain\Entities\RequestEntity;
use Untek\Framework\Telegram\Domain\Helpers\MatchHelper;

class DataBaseAction extends BaseAction
{

    public function run(RequestEntity $requestEntity)
    {
        $request = $requestEntity->getMessage()->getText();
        $sentences = WordHelper::textToSentences($request);

        foreach ($sentences as $sentence) {
            try {
                $answerText = $this->predict($sentence);
                if ($answerText) {
                    $this->response->sendMessage($requestEntity->getMessage()->getChat()->getId(), $answerText);
                    /*yield $this->messages->sendMessage([
                        'peer' => $update,
                        'message' => $answerText,
                        //'message' => implode(PHP_EOL, $sentences),
                        //'reply_to_msg_id' => isset($update['message']['id']) ? $update['message']['id'] : null,
                    ]);*/
                }
            } catch (NotFoundException $e) {
            }
        }
    }

    private function predict(string $request)
    {
        $request = MatchHelper::prepareString($request);
        $words = TextHelper::getWordArray($request);

        $container = ContainerHelper::getContainer();
        /** @var \Untek\Bundle\TalkBox\Domain\Services\PredictService $predictService */
        $predictService = $container->get(\Untek\Bundle\TalkBox\Domain\Services\PredictService::class);
        $answerText = $predictService->predict($words);
        return $answerText;
    }

}