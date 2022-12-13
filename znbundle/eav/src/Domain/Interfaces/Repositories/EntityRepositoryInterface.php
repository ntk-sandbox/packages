<?php

namespace ZnBundle\Eav\Domain\Interfaces\Repositories;

use ZnBundle\Eav\Domain\Entities\EntityEntity;
use ZnDomain\Repository\Interfaces\CrudRepositoryInterface;
use ZnDomain\Query\Entities\Query;

interface EntityRepositoryInterface extends CrudRepositoryInterface
{

    public function findOneByName(string $name, Query $query = null): EntityEntity;
}
