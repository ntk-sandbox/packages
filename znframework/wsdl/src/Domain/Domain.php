<?php

namespace Untek\Framework\Wsdl\Domain;

use Untek\Domain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'wsdl';
    }
}
