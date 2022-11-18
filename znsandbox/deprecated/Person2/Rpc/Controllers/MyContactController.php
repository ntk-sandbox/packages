<?php

namespace ZnSandbox\Sandbox\Person2\Rpc\Controllers;

use ZnBundle\Eav\Domain\Interfaces\Services\EntityServiceInterface;
use ZnDomain\Query\Entities\Query;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnFramework\Rpc\Rpc\Base\BaseCrudRpcController;
use ZnSandbox\Sandbox\Person2\Domain\Interfaces\Services\MyContactServiceInterface;

class MyContactController extends BaseCrudRpcController
{

    private $eavEntityService;

    public function __construct(MyContactServiceInterface $myContactService, EntityServiceInterface $eavEntityService)
    {
        $this->service = $myContactService;
        $this->eavEntityService = $eavEntityService;
    }

    public function allowRelations(): array
    {
        return [
            'attribute'
        ];
    }

    public function attributesOnly(): array
    {
        return [
            'id',
            'value',
            'attributeId',
            'attribute.id',
            'attribute.name',
            'attribute.title',
            'attribute.description',
        ];
    }

    public function createBatch(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $params = $requestEntity->getParams();
        $entity = $this->service->createBatch($params);
        return $this->serializeResult($entity);
    }
}
