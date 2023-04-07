<?php

namespace Untek\Tool\Dev\Runtime\Domain;

use Untek\Core\Code\Helpers\DeprecateHelper;
use Untek\Model\Shared\Interfaces\DomainInterface;

DeprecateHelper::hardThrow();

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'runtime';
    }

}