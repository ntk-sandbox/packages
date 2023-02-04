<?php

namespace Untek\Framework\Rpc\Domain\Events;

use Symfony\Contracts\EventDispatcher\Event;
use Untek\Core\EventDispatcher\Traits\EventSkipHandleTrait;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;

class RpcResponseEvent extends Event
{

    use EventSkipHandleTrait;

    private $requestEntity;
    private $responseEntity;

    public function __construct(RpcRequestEntity $requestEntity, RpcResponseEntity $responseEntity)
    {
        $this->requestEntity = $requestEntity;
        $this->responseEntity = $responseEntity;
    }

    public function getRequestEntity(): RpcRequestEntity
    {
        return $this->requestEntity;
    }

    public function getResponseEntity(): RpcResponseEntity
    {
        return $this->responseEntity;
    }
}
