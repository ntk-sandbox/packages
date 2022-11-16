<?php

namespace ZnBundle\Summary\Domain;

use ZnDomain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'summary';
    }


}

