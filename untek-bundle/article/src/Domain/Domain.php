<?php

namespace Untek\Bundle\Article\Domain;

use Untek\Domain\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'article';
    }

}