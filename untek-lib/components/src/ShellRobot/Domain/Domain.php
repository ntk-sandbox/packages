<?php

namespace Untek\Lib\Components\ShellRobot\Domain;

use Untek\Core\Code\Helpers\DeprecateHelper;
use Untek\Model\Shared\Interfaces\DomainInterface;

DeprecateHelper::hardThrow();

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'shellRobot';
    }
}
