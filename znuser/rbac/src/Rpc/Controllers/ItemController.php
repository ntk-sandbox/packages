<?php

namespace ZnUser\Rbac\Rpc\Controllers;

use ZnFramework\Rpc\Rpc\Base\BaseCrudRpcController;
use ZnUser\Rbac\Domain\Interfaces\Services\ItemServiceInterface;

class ItemController extends BaseCrudRpcController
{

    public function __construct(ItemServiceInterface $service)
    {
        $this->service = $service;
    }
}
