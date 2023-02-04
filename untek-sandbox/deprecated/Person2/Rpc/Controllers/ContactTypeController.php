<?php

namespace Untek\Sandbox\Sandbox\Person2\Rpc\Controllers;

use Untek\Framework\Rpc\Rpc\Base\BaseCrudRpcController;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Services\ContactTypeServiceInterface;

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
