<?php

namespace ZnFramework\Rpc\Rpc\Controllers;

use ZnFramework\Rpc\Rpc\Base\BaseCrudRpcController;
use ZnFramework\Rpc\Domain\Interfaces\Services\MethodServiceInterface;

class MethodController extends BaseCrudRpcController
{

    protected $service = null;

    public function __construct(MethodServiceInterface $service)
    {
        $this->service = $service;
    }

    public function allowRelations() : array
    {
        return [
            'permission',
        ];
    }
}
