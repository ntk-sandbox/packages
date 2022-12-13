<?php

namespace ZnBundle\Notify\Domain\Interfaces\Services;

use ZnBundle\Notify\Domain\Entities\SmsEntity;
use ZnBundle\Queue\Domain\Enums\PriorityEnum;

interface SmsServiceInterface
{

    public function push(SmsEntity $smsEntity, $priority = PriorityEnum::NORMAL);

}