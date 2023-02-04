<?php

namespace Untek\Bundle\TalkBox\Telegram\Actions;

use Untek\Framework\Telegram\Domain\Entities\RequestEntity;
use Untek\Framework\Telegram\Domain\Base\BaseAction;
use Untek\Framework\Telegram\Domain\Entities\MessageEntity;
use Untek\Framework\Telegram\Domain\Helpers\MatchHelper;
use danog\MadelineProto\APIFactory;


class SearchAction extends BaseAction
{

    private $patterns;

    public function __construct(array $patterns)
    {
        parent::__construct();
        $this->patterns = $patterns;
    }

    public function run(RequestEntity $requestEntity)
    {
        $request = $requestEntity->getMessage();
        $request = MatchHelper::prepareString($request);
        foreach ($this->patterns as $pattern) {
            $request = str_replace($pattern, '', $request);
        }
        $request = preg_replace('/([\W]+)/ui', ' ', $request);
        $request = MatchHelper::prepareString($request);
        $request = str_replace(' ', '+', $request);
        ///$request = StringHelper::vectorizeText($request);
        yield $this->response->sendMessage('http://www.google.ru/search?hl=ru&q=' . $request);
        /*yield $this->messages->sendMessage([
            'peer' => $update,
            'message' => ,
            // 'https://ru.wikipedia.org/w/index.php?sort=relevance&search='.$request.'&fulltext=1'
            //'message' => implode(PHP_EOL, $sentences),
            //'reply_to_msg_id' => isset($update['message']['id']) ? $update['message']['id'] : null,
        ]);*/
    }

}