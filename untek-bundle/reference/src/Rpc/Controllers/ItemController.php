<?php

namespace Untek\Bundle\Reference\Rpc\Controllers;

use Untek\Bundle\Reference\Domain\Filters\ItemFilter;
use Untek\Framework\Rpc\Presentation\Base\BaseCrudRpcController;
use Untek\Bundle\Reference\Domain\Interfaces\Services\ItemServiceInterface;

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
