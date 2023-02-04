<?php

namespace Untek\User\Rbac\Rpc\Controllers;

use Untek\Framework\Rpc\Rpc\Base\BaseCrudRpcController;
use Untek\User\Rbac\Domain\Interfaces\Services\RoleServiceInterface;

class RoleController extends BaseCrudRpcController
{

    public function __construct(RoleServiceInterface $service)
    {
        $this->service = $service;
    }
}
