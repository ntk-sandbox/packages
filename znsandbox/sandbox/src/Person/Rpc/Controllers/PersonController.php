<?php

namespace ZnSandbox\Sandbox\Person\Rpc\Controllers;

use ZnSandbox\Sandbox\Person\Domain\Interfaces\Services\PersonServiceInterface;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnFramework\Rpc\Rpc\Base\BaseCrudRpcController;

class PersonController extends BaseCrudRpcController
{

    public function __construct(PersonServiceInterface $personService)
    {
        $this->service = $personService;
    }

    public function findOneById(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $rpcMethod = $requestEntity->getMethod();
        $entityName = explode('.', $rpcMethod)[0];
        $id = $requestEntity->getParamItem('id');

        $entity = $this->service->findOneById($entityName, $id);
        $data = EntityHelper::toArray($entity);

        $response = new RpcResponseEntity();
        $response->setResult($data);
        return $response;
    }
}
