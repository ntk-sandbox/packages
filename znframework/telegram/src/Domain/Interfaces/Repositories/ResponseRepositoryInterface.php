<?php


namespace ZnFramework\Telegram\Domain\Interfaces\Repositories;

use ZnFramework\Telegram\Domain\Entities\BotEntity;
use ZnFramework\Telegram\Domain\Entities\ResponseEntity;

interface ResponseRepositoryInterface
{

    public function send(ResponseEntity $responseEntity, BotEntity $botEntity);

}