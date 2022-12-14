<?php

namespace ZnFramework\Telegram\Domain\Actions;

use danog\MadelineProto\APIFactory;
use ZnFramework\Telegram\Domain\Base\BaseAction;
use ZnFramework\Telegram\Domain\Entities\MessageEntity;
use ZnFramework\Telegram\Domain\Entities\RequestEntity;
use ZnFramework\Telegram\Domain\Entities\ResponseEntity;

class SaveDraftAction extends BaseAction
{

    private $text;

    public function __construct(string $text)
    {
        parent::__construct();
        $this->text = $text;
    }

    public function run(RequestEntity $messageEntity)
    {
        $responseEntity = new ResponseEntity;
        $responseEntity->setUserId($messageEntity->getUserId());
        $responseEntity->setMessage($this->text);
        $responseEntity->setMethod('saveDraft');
        return $this->response->send($responseEntity);
        /*return $this->messages->saveDraft([
            'peer' => $messageEntity->getUserId(),
            'message' => $this->text,
        ]);*/
    }
}
