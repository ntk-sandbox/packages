<?php

namespace Untek\Bundle\Geo\Rpc\Controllers;

use Untek\Framework\Rpc\Rpc\Base\BaseCrudRpcController;
use Untek\Bundle\Geo\Domain\Interfaces\Services\LocalityServiceInterface;

class LocalityController extends BaseCrudRpcController
{

    public function __construct(LocalityServiceInterface $service)
    {
        $this->service = $service;
    }
}
