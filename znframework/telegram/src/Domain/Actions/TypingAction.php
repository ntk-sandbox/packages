<?php

namespace ZnFramework\Telegram\Domain\Actions;

use ZnFramework\Telegram\Domain\Base\BaseAction;
use ZnFramework\Telegram\Domain\Entities\MessageEntity;
use ZnFramework\Telegram\Domain\Entities\RequestEntity;

class TypingAction extends BaseAction
{

    public function run(RequestEntity $messageEntity)
    {
        /*return $this->messages->setTyping([
            'peer' => $messageEntity->getUserId(),
            'action' => [
                '_' => 'SendMessageAction',
                'action' => 'updateUserTyping',
                'user_id' => $update['message']['from_id'],
            ],
        ]);*/
    }

}