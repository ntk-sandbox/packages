<?php

namespace ZnCrypt\Base\Domain;

use ZnDomain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'crypt_base';
    }
}
