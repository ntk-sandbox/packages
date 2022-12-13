<?php

namespace ZnSandbox\Sandbox\Application\Rpc\Controllers;

use ZnSandbox\Sandbox\Application\Domain\Interfaces\Services\ApplicationServiceInterface;
use ZnFramework\Rpc\Rpc\Base\BaseCrudRpcController;

class ApplicationController extends BaseCrudRpcController
{

    public function __construct(ApplicationServiceInterface $service)
    {
        $this->service = $service;
    }
}
