<?php


namespace Untek\User\Notify\Domain\Interfaces\Libs;

use Untek\User\Notify\Domain\Entities\NotifyEntity;

interface ContactDriverInterface
{

    public function send(NotifyEntity $notifyEntity);
}