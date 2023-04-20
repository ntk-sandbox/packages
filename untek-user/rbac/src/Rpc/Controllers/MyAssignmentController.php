<?php

namespace Untek\User\Rbac\Rpc\Controllers;

use Untek\Model\Entity\Helpers\EntityHelper;
use Untek\Framework\Rpc\Domain\Model\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Model\RpcResponseEntity;
use Untek\User\Rbac\Domain\Interfaces\Services\MyAssignmentServiceInterface;

class MyAssignmentController
{

    public function __construct(MyAssignmentServiceInterface $service)
    {
        $this->service = $service;
    }

    public function allRoles(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $resultArray = $this->service->allNames();
        $response = new RpcResponseEntity();
        $response->setResult($resultArray);
        return $response;
    }

    public function allPermissions(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $resultArray = $this->service->allPermissions();
        $response = new RpcResponseEntity();
        $response->setResult($resultArray);
        return $response;
    }
}
