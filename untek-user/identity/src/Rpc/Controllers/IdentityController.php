<?php

namespace Untek\User\Identity\Rpc\Controllers;

use Untek\User\Identity\Domain\Interfaces\Services\IdentityServiceInterface;
use Untek\Framework\Rpc\Presentation\Base\BaseCrudRpcController;

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
