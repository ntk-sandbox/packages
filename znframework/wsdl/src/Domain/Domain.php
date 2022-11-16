<?php

namespace ZnFramework\Wsdl\Domain;

use ZnDomain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'wsdl';
    }
}
