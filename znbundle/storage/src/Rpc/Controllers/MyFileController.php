<?php

namespace Untek\Bundle\Storage\Rpc\Controllers;

use Untek\Bundle\Storage\Domain\Interfaces\Services\MyFileServiceInterface;
use Untek\User\Identity\Domain\Interfaces\Services\IdentityServiceInterface;
use Untek\Framework\Rpc\Rpc\Base\BaseCrudRpcController;

class MyFileController extends BaseCrudRpcController
{

    public function __construct(MyFileServiceInterface $myFileService)
    {
        $this->service = $myFileService;
    }

    /*public function allowRelations(): array
    {
        return [
            'person'
        ];
    }*/
}
