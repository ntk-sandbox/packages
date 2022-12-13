<?php

namespace ZnSandbox\Sandbox\RpcMock\Rpc\Controllers;

use ZnFramework\Rpc\Rpc\Base\BaseCrudRpcController;
use ZnSandbox\Sandbox\RpcMock\Domain\Interfaces\Services\MethodServiceInterface;

class MethodController extends BaseCrudRpcController
{

    protected $service = null;

    public function __construct(MethodServiceInterface $service)
    {
        $this->service = $service;
    }

    public function allowRelations() : array
    {
        return [];
    }


}

