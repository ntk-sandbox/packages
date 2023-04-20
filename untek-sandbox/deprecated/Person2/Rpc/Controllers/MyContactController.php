<?php

namespace Untek\Sandbox\Sandbox\Person2\Rpc\Controllers;

use Untek\Bundle\Eav\Domain\Interfaces\Services\EntityServiceInterface;
use Untek\Model\Query\Entities\Query;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Framework\Rpc\Presentation\Base\BaseCrudRpcController;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Services\MyContactServiceInterface;

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
