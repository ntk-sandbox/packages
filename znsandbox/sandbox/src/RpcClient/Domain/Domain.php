<?php

namespace ZnSandbox\Sandbox\RpcClient\Domain;

use ZnDomain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'rpc-client';
    }


}

