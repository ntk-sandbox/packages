<?php

namespace ZnUser\Rbac\Rpc\Controllers;

use ZnCore\Collection\Helpers\CollectionHelper;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnUser\Rbac\Domain\Entities\AssignmentEntity;
use ZnUser\Rbac\Domain\Interfaces\Services\AssignmentServiceInterface;

class AssignmentController
{

    public function __construct(AssignmentServiceInterface $service)
    {
        $this->service = $service;
    }

    public function attach(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $assignmentEntity = new AssignmentEntity();
        $assignmentEntity->setIdentityId($requestEntity->getParamItem('identityId'));
        $assignmentEntity->setItemName($requestEntity->getParamItem('itemName'));
        $this->service->attach($assignmentEntity);
        $response = new RpcResponseEntity();
        return $response;
    }

    public function detach(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $assignmentEntity = new AssignmentEntity();
        $assignmentEntity->setIdentityId($requestEntity->getParamItem('identityId'));
        $assignmentEntity->setItemName($requestEntity->getParamItem('itemName'));
        $this->service->detach($assignmentEntity);
        $response = new RpcResponseEntity();
        return $response;
    }

    public function allRoles(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $collection = $this->service->allByIdentityId($requestEntity->getParamItem('identityId'));
        $resultArray = CollectionHelper::toArray($collection);
        $response = new RpcResponseEntity();
        $response->setResult($resultArray);
        return $response;
    }
}
