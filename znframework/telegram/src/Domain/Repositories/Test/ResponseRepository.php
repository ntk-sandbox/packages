<?php


namespace ZnFramework\Telegram\Domain\Repositories\Test;

use ZnFramework\Telegram\Domain\Entities\BotEntity;
use ZnFramework\Telegram\Domain\Entities\ResponseEntity;
use ZnFramework\Telegram\Domain\Interfaces\Repositories\ResponseRepositoryInterface;
use ZnFramework\Telegram\Domain\Services\RequestService;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnLib\Components\Store\StoreFile;

class ResponseRepository implements ResponseRepositoryInterface
{

    private $requestService;

    public function __construct(RequestService $requestService)
    {
        $this->requestService = $requestService;
    }

    public function send(ResponseEntity $responseEntity, BotEntity $botEntity)
    {
        $data = EntityHelper::toArrayForTablize($responseEntity);
        $file = $this->fileName($botEntity->getId(), $responseEntity->getChatId());
        $store = new StoreFile($file);
        $collection = $store->load();

        $requestData = [
            "chat_id" => $botEntity->getId(),
            "text" => $this->requestService->getRequest()->getMessage()->getText(),
            /*"parse_mode" => "HTML",
            "disable_web_page_preview" => "false",
            "disable_notification" => "false"*/
        ];

        $collection[] = $requestData;
        $collection[] = $data;
        $store->save($collection);
    }

    public function findAll(int $botId, int $chatId)
    {
        $file = $this->fileName($botId, $chatId);
        $store = new StoreFile($file);
        return $store->load();
    }

    private function fileName(int $botId, int $chatId)
    {
        return __DIR__ . '/../../../../var/dev/chat/' . $botId . '.json';
    }
}