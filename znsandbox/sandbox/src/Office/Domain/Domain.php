<?php

namespace ZnSandbox\Sandbox\Office\Domain;

use ZnDomain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'office';
    }


}

