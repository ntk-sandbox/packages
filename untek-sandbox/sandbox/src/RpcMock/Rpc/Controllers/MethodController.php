<?php

namespace Untek\Sandbox\Sandbox\RpcMock\Rpc\Controllers;

use Untek\Framework\Rpc\Presentation\Base\BaseCrudRpcController;
use Untek\Sandbox\Sandbox\RpcMock\Domain\Interfaces\Services\MethodServiceInterface;

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

