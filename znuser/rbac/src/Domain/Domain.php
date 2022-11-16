<?php

namespace ZnUser\Rbac\Domain;

use ZnDomain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'rbac';
    }


}

