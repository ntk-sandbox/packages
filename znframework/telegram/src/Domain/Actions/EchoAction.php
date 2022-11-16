<?php

namespace ZnFramework\Telegram\Domain\Actions;

use ZnFramework\Telegram\Domain\Base\BaseAction;
use ZnFramework\Telegram\Domain\Entities\RequestEntity;

class EchoAction extends BaseAction
{

    public function run(RequestEntity $requestEntity)
    {
        $this->response->sendMessage($requestEntity->getMessage()->getChat()->getId(), $requestEntity->getMessage()->getText());
    }

}