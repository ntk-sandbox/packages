<?php

namespace Untek\Framework\Rpc\Rpc\Controllers;

use Untek\Framework\Rpc\Rpc\Base\BaseCrudRpcController;
use Untek\Framework\Rpc\Domain\Interfaces\Services\MethodServiceInterface;

class MethodController extends BaseCrudRpcController
{

    protected $service = null;

    public function __construct(MethodServiceInterface $service)
    {
        $this->service = $service;
    }

    public function allowRelations() : array
    {
        return [
            'permission',
        ];
    }
}
