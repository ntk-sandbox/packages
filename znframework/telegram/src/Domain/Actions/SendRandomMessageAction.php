<?php

namespace ZnFramework\Telegram\Domain\Actions;

use danog\MadelineProto\APIFactory;
use ZnFramework\Telegram\Domain\Base\BaseAction;
use ZnFramework\Telegram\Domain\Entities\MessageEntity;
use ZnFramework\Telegram\Domain\Entities\RequestEntity;

class SendRandomMessageAction extends BaseAction
{

    private $responseList;

    public function __construct(array $responseList)
    {
        parent::__construct();
        $this->responseList = $responseList;
    }

    public function run(RequestEntity $messageEntity)
    {
        $count = count($this->responseList);
        $randIndex = mt_rand(0, $count - 1);
        return $this->response->sendMessage($this->responseList[$randIndex], $messageEntity->getUserId());
    }

}