<?php

namespace Untek\User\Rbac\Rpc\Controllers;

use Untek\Core\Collection\Helpers\CollectionHelper;
use Untek\Model\Entity\Helpers\EntityHelper;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\User\Rbac\Domain\Entities\AssignmentEntity;
use Untek\User\Rbac\Domain\Interfaces\Services\AssignmentServiceInterface;

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
