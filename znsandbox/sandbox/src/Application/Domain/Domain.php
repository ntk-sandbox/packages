<?php

namespace ZnSandbox\Sandbox\Application\Domain;

use ZnDomain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'application';
    }


}

