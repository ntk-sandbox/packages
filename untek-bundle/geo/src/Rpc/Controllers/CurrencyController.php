<?php

namespace Untek\Bundle\Geo\Rpc\Controllers;

use Untek\Framework\Rpc\Presentation\Base\BaseCrudRpcController;
use Untek\Bundle\Geo\Domain\Interfaces\Services\CurrencyServiceInterface;

class CurrencyController extends BaseCrudRpcController
{

    public function __construct(CurrencyServiceInterface $service)
    {
        $this->service = $service;
    }
}
