<?php

namespace ZnSandbox\Sandbox\Redmine\Domain;

use ZnDomain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'redmine';
    }
}
