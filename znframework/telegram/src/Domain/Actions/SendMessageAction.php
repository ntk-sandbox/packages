<?php

namespace ZnFramework\Telegram\Domain\Actions;

use ZnFramework\Telegram\Domain\Entities\RequestEntity;
use danog\MadelineProto\APIFactory;
use ZnFramework\Telegram\Domain\Base\BaseAction;
use ZnFramework\Telegram\Domain\Entities\MessageEntity;

class SendMessageAction extends BaseAction
{

    private $text;

    public function __construct(string $text)
    {
        parent::__construct();
        $this->text = $text;
    }

    public function run(RequestEntity $requestEntity)
    {
        return $this->response->sendMessage($requestEntity->getMessage()->getChat()->getId(), $this->text);
        /*return $this->messages->sendMessage([
            'peer' => $update,
            'message' => $this->text,
            //'reply_to_msg_id' => isset($update['message']['id']) ? $update['message']['id'] : null,
        ]);*/
    }

}