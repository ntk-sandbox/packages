<?php

namespace Untek\User\Person\Rpc\Controllers;

use Untek\Bundle\Eav\Domain\Interfaces\Services\EntityServiceInterface;
use Untek\Model\Query\Entities\Query;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Framework\Rpc\Presentation\Base\BaseCrudRpcController;
use Untek\User\Person\Domain\Interfaces\Services\ContactServiceInterface;

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
