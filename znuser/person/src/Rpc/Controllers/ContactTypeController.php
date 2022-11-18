<?php

namespace ZnUser\Person\Rpc\Controllers;

use ZnFramework\Rpc\Rpc\Base\BaseCrudRpcController;
use ZnUser\Person\Domain\Interfaces\Services\ContactTypeServiceInterface;

class ContactTypeController extends BaseCrudRpcController
{

    private $entityAttributeService;
    private $entityId;

    public function __construct(ContactTypeServiceInterface $contactTypeService)
    {
        $this->service = $contactTypeService;
    }

    public function allowRelations(): array
    {
        return [
            'attributesTie.attribute'
        ];
    }

    public function attributesOnly(): array
    {
        return [
            'id',
            'name',
            'type',
            'title',
        ];
    }
}
