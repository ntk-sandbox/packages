<?php

namespace ZnFramework\Rpc\Domain\Events;

use Symfony\Contracts\EventDispatcher\Event;
use ZnCore\EventDispatcher\Traits\EventSkipHandleTrait;
use ZnFramework\Rpc\Domain\Entities\MethodEntity;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;

class RpcRequestEvent extends Event
{

    use EventSkipHandleTrait;

    private $requestEntity;
    private $methodEntity;

    public function __construct(RpcRequestEntity $requestEntity, MethodEntity $methodEntity = null)
    {
        $this->requestEntity = $requestEntity;
        $this->methodEntity = $methodEntity;
    }

    public function getRequestEntity(): RpcRequestEntity
    {
        return $this->requestEntity;
    }

    public function getMethodEntity(): MethodEntity
    {
        return $this->methodEntity;
    }
}
