<?php

namespace Untek\User\Rbac\Rpc\Controllers;

use Untek\Framework\Rpc\Presentation\Base\BaseCrudRpcController;
use Untek\User\Rbac\Domain\Interfaces\Services\PermissionServiceInterface;

class PermissionController extends BaseCrudRpcController
{

    protected $pageSizeMax = 200;

    public function __construct(PermissionServiceInterface $service)
    {
        $this->service = $service;
    }
}
