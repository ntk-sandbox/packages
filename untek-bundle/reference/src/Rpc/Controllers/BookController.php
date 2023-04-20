<?php

namespace Untek\Bundle\Reference\Rpc\Controllers;

use Untek\Framework\Rpc\Presentation\Base\BaseCrudRpcController;
use Untek\Bundle\Reference\Domain\Interfaces\Services\BookServiceInterface;

class BookController extends BaseCrudRpcController
{

    protected $service = null;

    public function __construct(BookServiceInterface $service)
    {
        $this->service = $service;
    }

    public function allowRelations() : array
    {
        return [];
    }


}

