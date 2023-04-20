<?php

namespace Untek\Sandbox\Sandbox\Person\Rpc\Controllers;

use Untek\Sandbox\Sandbox\Person\Domain\Interfaces\Services\PersonServiceInterface;
use Untek\Model\Entity\Helpers\EntityHelper;
use Untek\Framework\Rpc\Domain\Model\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Model\RpcResponseEntity;
use Untek\Framework\Rpc\Presentation\Base\BaseCrudRpcController;

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
