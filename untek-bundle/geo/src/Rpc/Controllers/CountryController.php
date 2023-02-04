<?php

namespace Untek\Bundle\Geo\Rpc\Controllers;

use Untek\Framework\Rpc\Rpc\Base\BaseCrudRpcController;
use Untek\Bundle\Geo\Domain\Interfaces\Services\CountryServiceInterface;

class CountryController extends BaseCrudRpcController
{

    public function __construct(CountryServiceInterface $service)
    {
        $this->service = $service;
    }
}
