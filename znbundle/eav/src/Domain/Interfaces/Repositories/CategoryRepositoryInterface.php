<?php

namespace ZnBundle\Eav\Domain\Interfaces\Repositories;

use ZnBundle\Eav\Domain\Entities\CategoryEntity;
use ZnDomain\Repository\Interfaces\CrudRepositoryInterface;
use ZnDomain\Query\Entities\Query;

interface CategoryRepositoryInterface extends CrudRepositoryInterface
{

    public function findOneByName(string $name, Query $query = null): CategoryEntity;
}
