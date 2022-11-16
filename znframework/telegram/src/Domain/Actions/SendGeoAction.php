<?php

namespace ZnFramework\Telegram\Domain\Actions;

use ZnFramework\Telegram\Domain\Entities\RequestEntity;
use ZnFramework\Telegram\Domain\Entities\ResponseEntity;
use danog\MadelineProto\APIFactory;
use ZnFramework\Telegram\Domain\Base\BaseAction;
use ZnFramework\Telegram\Domain\Entities\MessageEntity;

class SendGeoAction extends BaseAction
{

    public function __construct($long, $lat)
    {
        parent::__construct();
    }

    public function run(RequestEntity $requestEntity)
    {
        $messageEntity = $requestEntity->getMessage();
        $fromId = $messageEntity->getFrom()->getId();
        $chatId = $messageEntity->getChat()->getId();
        $longStr = '73.10441998' . mt_rand(1000, 9999);
        $latStr = '49.80095066' . mt_rand(1000, 9999);

        $responseEntity = new ResponseEntity;
        $responseEntity->setChatId($chatId);
        $responseEntity->setText('kjhgfd');
        $responseEntity->setMedia([
            '_' => 'inputMediaGeoPoint',
            'geo_point' => [
                '_' => 'inputGeoPoint',
                'long' => $longStr,
                'lat' => $latStr,
            ],
        ]);
        $responseEntity->setMethod('sendMedia');
        $responseEntity->setParseMode('HTML');
        $responseEntity->setDisableWebPagePreview('false');
        $responseEntity->setDisableNotification('false');
        //$this->send($responseEntity);



        /*$responseEntity = new ResponseEntity;
        $responseEntity->setUserId($messageEntity->getFrom()->getId());
        $responseEntity->setMedia([
            '_' => 'inputMediaGeoPoint',
            'geo_point' => [
                '_' => 'inputGeoPoint',
                'long' => $longStr,
                'lat' => $latStr,
            ],
        ]);
        $responseEntity->setMethod('sendMedia');
        $responseEntity->setReplyMessageId($messageEntity->getId());*/
        return $this->response->send($responseEntity);
    }

}