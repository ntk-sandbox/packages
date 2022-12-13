<?php

namespace ZnBundle\Notify\Domain\Interfaces\Services;

use ZnBundle\Notify\Domain\Entities\EmailEntity;
use ZnBundle\Queue\Domain\Enums\PriorityEnum;

interface EmailServiceInterface
{

    public function push(EmailEntity $emailEntity, $priority = PriorityEnum::NORMAL);

}