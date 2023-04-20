<?php

namespace Untek\Sandbox\Sandbox\Application\Rpc\Controllers;

use Untek\Sandbox\Sandbox\Application\Domain\Interfaces\Services\ApplicationServiceInterface;
use Untek\Framework\Rpc\Presentation\Base\BaseCrudRpcController;

class ApplicationController extends BaseCrudRpcController
{

    public function __construct(ApplicationServiceInterface $service)
    {
        $this->service = $service;
    }
}
