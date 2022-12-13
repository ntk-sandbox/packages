<?php


namespace ZnUser\Notify\Domain\Interfaces\Libs;

use ZnUser\Notify\Domain\Entities\NotifyEntity;

interface ContactDriverInterface
{

    public function send(NotifyEntity $notifyEntity);
}