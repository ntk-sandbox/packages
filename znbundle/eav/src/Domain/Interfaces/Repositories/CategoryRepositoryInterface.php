<?php

namespace Untek\Bundle\Eav\Domain\Interfaces\Repositories;

use Untek\Bundle\Eav\Domain\Entities\CategoryEntity;
use Untek\Domain\Repository\Interfaces\CrudRepositoryInterface;
use Untek\Domain\Query\Entities\Query;

interface CategoryRepositoryInterface extends CrudRepositoryInterface
{

    public function findOneByName(string $name, Query $query = null): CategoryEntity;
}
