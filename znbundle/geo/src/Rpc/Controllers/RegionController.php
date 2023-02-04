<?php

namespace Untek\Bundle\Geo\Rpc\Controllers;

use Untek\Framework\Rpc\Rpc\Base\BaseCrudRpcController;
use Untek\Bundle\Geo\Domain\Interfaces\Services\RegionServiceInterface;

class RegionController extends BaseCrudRpcController
{

    public function __construct(RegionServiceInterface $service)
    {
        $this->service = $service;
    }
}
