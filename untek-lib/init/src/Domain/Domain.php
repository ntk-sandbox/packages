<?php

namespace Untek\Lib\Init\Domain;

use Untek\Core\Code\Helpers\DeprecateHelper;
use Untek\Domain\Domain\Interfaces\DomainInterface;

DeprecateHelper::hardThrow();

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'init';
    }


}

