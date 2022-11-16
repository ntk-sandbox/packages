<?php

namespace ZnSandbox\Sandbox\RpcMock\Domain;

use ZnDomain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'rpc-mock';
    }

}
