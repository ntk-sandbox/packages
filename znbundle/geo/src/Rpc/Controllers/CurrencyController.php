<?php

namespace ZnBundle\Geo\Rpc\Controllers;

use ZnFramework\Rpc\Rpc\Base\BaseCrudRpcController;
use ZnBundle\Geo\Domain\Interfaces\Services\CurrencyServiceInterface;

class CurrencyController extends BaseCrudRpcController
{

    public function __construct(CurrencyServiceInterface $service)
    {
        $this->service = $service;
    }
}
