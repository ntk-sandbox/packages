<?php

namespace ZnFramework\Telegram\Domain\Actions;

use ZnFramework\Telegram\Domain\Entities\RequestEntity;
use ZnFramework\Telegram\Domain\Entities\ResponseEntity;
use danog\MadelineProto\APIFactory;
use ZnFramework\Telegram\Domain\Base\BaseAction;
use ZnFramework\Telegram\Domain\Entities\MessageEntity;

class SendButtonAction extends BaseAction
{

    private $buttons;
    private $text;

    public function __construct(string $text, array $buttons)
    {
        parent::__construct();
        $this->buttons = $buttons;
        $this->text = $text;
    }

    public function run(RequestEntity $requestEntity)
    {
        $messageEntity = $requestEntity->getMessage();
        //$fromId = $messageEntity->getFrom()->getId();
        $chatId = $messageEntity->getChat()->getId();

        $responseEntity = new ResponseEntity;
        $responseEntity->setChatId($chatId);
        $responseEntity->setText($this->text);

        $responseEntity->setKeyboard($this->buttons);
        $responseEntity->setParseMode('HTML');
        $responseEntity->setDisableWebPagePreview('false');
        $responseEntity->setDisableNotification('false');
        return $this->response->send($responseEntity);
    }
}