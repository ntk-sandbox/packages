<?php

namespace Untek\Framework\Wsdl\Domain\Interfaces\Services;

use Untek\Framework\Wsdl\Domain\Entities\TransportEntity;
use Untek\Model\Service\Interfaces\CrudServiceInterface;

interface TransportServiceInterface extends CrudServiceInterface
{

    public function sendAll(): void;

    public function send(TransportEntity $transportEntity): void;
}
