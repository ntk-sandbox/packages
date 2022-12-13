<?php

namespace ZnUser\Identity\Rpc\Controllers;

use ZnUser\Identity\Domain\Interfaces\Services\IdentityServiceInterface;
use ZnFramework\Rpc\Rpc\Base\BaseCrudRpcController;

class IdentityController extends BaseCrudRpcController
{

    public function __construct(IdentityServiceInterface $authService)
    {
        $this->service = $authService;
    }

    public function allowRelations(): array
    {
        return [
            'person'
        ];
    }
}
