<?php

namespace Untek\Tool\Dev\Runtime\Domain;

use Untek\Domain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'runtime';
    }

}