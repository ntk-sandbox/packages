<?php

namespace ZnSandbox\Sandbox\Person2\Rpc\Controllers;

use ZnDomain\Query\Entities\Query;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnFramework\Rpc\Rpc\Base\BaseRpcController;
use ZnSandbox\Sandbox\Person2\Domain\Interfaces\Services\MyPersonServiceInterface;

class MyPersonController extends BaseRpcController
{

    public function __construct(MyPersonServiceInterface $personService)
    {
        $this->service = $personService;
    }

    public function allowRelations(): array
    {
        return [
            'contacts',
            'contacts.attribute',
            'sex',
        ];
    }

    public function attributesExclude(): array
    {
        return [
            'id',
            'identityId',
//            'attributes',
        ];
    }

    public function one(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $query = new Query();
        $this->forgeWith($requestEntity, $query);
        $personEntity = $this->service->findOne($query);
        return $this->serializeResult($personEntity);
    }

    public function update(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $data = $requestEntity->getParams();
        $this->service->update($data);
        return $this->serializeResult(null);
    }
}
