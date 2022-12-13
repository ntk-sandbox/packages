<?php

namespace ZnFramework\Rpc\Domain\Events;

use Symfony\Contracts\EventDispatcher\Event;
use ZnCore\EventDispatcher\Traits\EventSkipHandleTrait;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnSandbox\Sandbox\RpcClient\Symfony4\Admin\Forms\RequestForm;

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
