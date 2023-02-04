<?php

namespace Untek\Lib\Components\ShellRobot\Domain;

use Untek\Domain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'shellRobot';
    }
}
