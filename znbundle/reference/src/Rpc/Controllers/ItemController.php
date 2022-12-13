<?php

namespace ZnBundle\Reference\Rpc\Controllers;

use ZnBundle\Reference\Domain\Filters\ItemFilter;
use ZnFramework\Rpc\Rpc\Base\BaseCrudRpcController;
use ZnBundle\Reference\Domain\Interfaces\Services\ItemServiceInterface;

class ItemController extends BaseCrudRpcController
{

    protected $service = null;
    protected $filterModel = ItemFilter::class;

    public function __construct(ItemServiceInterface $service)
    {
        $this->service = $service;
    }

    public function allowRelations() : array
    {
        return [
            'book',
        ];
    }
}
