<?php

namespace ZnSandbox\Sandbox\Contact\Domain;

use ZnDomain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'contact';
    }

}