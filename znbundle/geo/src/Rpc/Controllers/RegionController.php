<?php

namespace ZnBundle\Geo\Rpc\Controllers;

use ZnFramework\Rpc\Rpc\Base\BaseCrudRpcController;
use ZnBundle\Geo\Domain\Interfaces\Services\RegionServiceInterface;

class RegionController extends BaseCrudRpcController
{

    public function __construct(RegionServiceInterface $service)
    {
        $this->service = $service;
    }
}
