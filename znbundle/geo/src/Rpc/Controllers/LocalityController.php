<?php

namespace ZnBundle\Geo\Rpc\Controllers;

use ZnFramework\Rpc\Rpc\Base\BaseCrudRpcController;
use ZnBundle\Geo\Domain\Interfaces\Services\LocalityServiceInterface;

class LocalityController extends BaseCrudRpcController
{

    public function __construct(LocalityServiceInterface $service)
    {
        $this->service = $service;
    }
}
