<?php

namespace ZnLib\Init\Domain;

use ZnDomain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'init';
    }


}

