<?php

namespace Untek\Framework\Rpc\Domain\Events;

use Symfony\Contracts\EventDispatcher\Event;
use Untek\Core\EventDispatcher\Traits\EventSkipHandleTrait;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Sandbox\Sandbox\RpcClient\Symfony4\Admin\Forms\RequestForm;

class RpcClientRequestEvent extends Event
{

    use EventSkipHandleTrait;

    private $requestEntity;
    private $responseEntity;
    private $requestForm;

    public function __construct(
        RpcRequestEntity $requestEntity,
        RpcResponseEntity $responseEntity,
        RequestForm $requestForm
    ) {
        $this->requestEntity = $requestEntity;
        $this->responseEntity = $responseEntity;
        $this->requestForm = $requestForm;
    }

    public function getRequestEntity(): RpcRequestEntity
    {
        return $this->requestEntity;
    }

    public function getResponseEntity(): RpcResponseEntity
    {
        return $this->responseEntity;
    }

    public function getRequestForm(): RequestForm
    {
        return $this->requestForm;
    }
}
