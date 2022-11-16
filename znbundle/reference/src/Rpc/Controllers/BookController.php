<?php

namespace ZnBundle\Reference\Rpc\Controllers;

use ZnFramework\Rpc\Rpc\Base\BaseCrudRpcController;
use ZnBundle\Reference\Domain\Interfaces\Services\BookServiceInterface;

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

