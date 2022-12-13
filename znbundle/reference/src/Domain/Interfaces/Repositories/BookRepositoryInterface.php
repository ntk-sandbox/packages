<?php

namespace ZnBundle\Reference\Domain\Interfaces\Repositories;

use ZnBundle\Reference\Domain\Entities\BookEntity;
use ZnDomain\Repository\Interfaces\CrudRepositoryInterface;
use ZnDomain\Query\Entities\Query;

interface BookRepositoryInterface extends CrudRepositoryInterface
{

    public function findOneByName(string $name, Query $query = null): BookEntity;
    
}
