<?php


namespace ZnFramework\Telegram\Domain\Repositories\Messenger;

use ZnFramework\Telegram\Domain\Entities\BotEntity;
use ZnFramework\Telegram\Domain\Entities\ResponseEntity;
use ZnFramework\Telegram\Domain\Helpers\HttpHelper;
use ZnFramework\Telegram\Domain\Interfaces\Repositories\ResponseRepositoryInterface;
use danog\MadelineProto\Exception;
use ZnDomain\Entity\Helpers\EntityHelper;

class ResponseRepository implements ResponseRepositoryInterface
{

    const URL = 'http://symfony.tpl/api/v1';

    public function send(ResponseEntity $responseEntity, BotEntity $botEntity)
    {
        $data = EntityHelper::toArrayForTablize($responseEntity);
        $query = http_build_query($data);
        $token = $botEntity->getToken();
        $uri = "bot/$token/send-message";
        $url = self::URL . "/$uri?$query";
        $json = HttpHelper::getHtml($url);
        $data = json_decode($json);
        if (empty($data->ok)) {
            //dd($data);
            throw new Exception('Driver error! ' . $json);
        }
    }

}