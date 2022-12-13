<?php

namespace ZnBundle\Notify\Domain\Repositories\Telegram;

use ZnBundle\Notify\Domain\Entities\SmsEntity;
use ZnBundle\Notify\Domain\Interfaces\Repositories\SmsRepositoryInterface;
use ZnFramework\Telegram\Domain\Facades\Bot;

class SmsRepository implements SmsRepositoryInterface
{

    public function send(SmsEntity $smsEntity)
    {
        $message =
            '# SMS' . PHP_EOL .
            'Phone: ' . $smsEntity->getPhone() . PHP_EOL .
            'Message: ' . $smsEntity->getMessage();
        Bot::sendMessage($message);
    }
}
