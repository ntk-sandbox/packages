<?php

namespace Untek\User\Notify\Domain\Interfaces\Services;

use Untek\Model\Service\Interfaces\CrudServiceInterface;
use Untek\User\Notify\Domain\Entities\NotifyEntity;

interface TransportServiceInterface extends CrudServiceInterface
{

    public function send(NotifyEntity $notifyEntity);
}

