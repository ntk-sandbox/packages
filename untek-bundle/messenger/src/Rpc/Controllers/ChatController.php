<?php

namespace Untek\Bundle\Messenger\Rpc\Controllers;

use Untek\Bundle\Messenger\Domain\Interfaces\ChatServiceInterface;
use Untek\Bundle\Messenger\Domain\Interfaces\Services\TournamentServiceInterface;
use Untek\Framework\Rpc\Presentation\Base\BaseCrudRpcController;

class ChatController extends BaseCrudRpcController
{

    public function __construct(ChatServiceInterface $service)
    {
        $this->service = $service;
    }
}
