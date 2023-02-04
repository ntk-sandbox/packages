<?php

namespace Untek\User\Rbac\Rpc\Controllers;

use Untek\Framework\Rpc\Rpc\Base\BaseCrudRpcController;
use Untek\User\Rbac\Domain\Interfaces\Services\ItemServiceInterface;

class ItemController extends BaseCrudRpcController
{

    public function __construct(ItemServiceInterface $service)
    {
        $this->service = $service;
    }
}
