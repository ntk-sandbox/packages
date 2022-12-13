<?php

namespace ZnFramework\Telegram\Domain\Actions;

use danog\MadelineProto\APIFactory;
use danog\MadelineProto\EventHandler;
use ZnFramework\Telegram\Domain\Base\BaseAction;
use ZnFramework\Telegram\Domain\Entities\MessageEntity;
use ZnFramework\Telegram\Domain\Entities\RequestEntity;

class ShutdownHandlerAction extends BaseAction
{

    private $eventHandler;

    public function __construct(EventHandler $eventHandler)
    {
        parent::__construct($messages);
        $this->eventHandler = $eventHandler;
    }

    public function run(RequestEntity $messageEntity)
    {
        $this->eventHandler->stop();
    }

}