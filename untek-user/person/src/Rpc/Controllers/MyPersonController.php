<?php

namespace Untek\User\Person\Rpc\Controllers;

use Untek\Model\Query\Entities\Query;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Framework\Rpc\Presentation\Base\BaseRpcController;
use Untek\User\Person\Domain\Interfaces\Services\MyPersonServiceInterface;

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
