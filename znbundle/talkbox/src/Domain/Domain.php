<?php

namespace ZnBundle\TalkBox\Domain;

use ZnDomain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'dialog';
    }

}
