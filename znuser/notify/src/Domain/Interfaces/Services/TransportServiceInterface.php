<?php

namespace ZnUser\Notify\Domain\Interfaces\Services;

use ZnDomain\Service\Interfaces\CrudServiceInterface;
use ZnUser\Notify\Domain\Entities\NotifyEntity;

interface TransportServiceInterface extends CrudServiceInterface
{

    public function send(NotifyEntity $notifyEntity);
}

