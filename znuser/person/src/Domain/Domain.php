<?php

namespace ZnUser\Person\Domain;

use ZnDomain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'person';
    }
}
