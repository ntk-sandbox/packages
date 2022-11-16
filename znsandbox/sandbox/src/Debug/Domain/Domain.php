<?php

namespace ZnSandbox\Sandbox\Debug\Domain;

use ZnDomain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'debug';
    }
}
