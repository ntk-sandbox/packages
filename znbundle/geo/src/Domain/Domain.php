<?php

namespace ZnBundle\Geo\Domain;

use ZnDomain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'geo';
    }


}

