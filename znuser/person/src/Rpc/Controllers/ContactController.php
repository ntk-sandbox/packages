<?php

namespace ZnUser\Person\Rpc\Controllers;

use ZnBundle\Eav\Domain\Interfaces\Services\EntityServiceInterface;
use ZnDomain\Query\Entities\Query;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnFramework\Rpc\Rpc\Base\BaseCrudRpcController;
use ZnUser\Person\Domain\Interfaces\Services\ContactServiceInterface;

class ContactController extends BaseCrudRpcController
{

    private $eavEntityService;

    public function __construct(ContactServiceInterface $contactService, EntityServiceInterface $eavEntityService)
    {
        $this->service = $contactService;
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

    public function allByPersonId(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $params = $requestEntity->getParams();
        $collection = $this->service->allByPersonId($params['personId']);
        return $this->serializeResult($collection);
    }
}
