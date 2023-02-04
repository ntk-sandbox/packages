<?php

namespace Untek\Lib\Init\Domain;

use Untek\Domain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'init';
    }


}

