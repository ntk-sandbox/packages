<?php

namespace ZnLib\Components\ShellRobot\Domain;

use ZnDomain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'shellRobot';
    }
}
