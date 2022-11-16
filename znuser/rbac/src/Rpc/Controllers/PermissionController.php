<?php

namespace ZnUser\Rbac\Rpc\Controllers;

use ZnFramework\Rpc\Rpc\Base\BaseCrudRpcController;
use ZnUser\Rbac\Domain\Interfaces\Services\PermissionServiceInterface;

class PermissionController extends BaseCrudRpcController
{

    protected $pageSizeMax = 200;

    public function __construct(PermissionServiceInterface $service)
    {
        $this->service = $service;
    }
}
