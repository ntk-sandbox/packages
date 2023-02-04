<?php

namespace Untek\Bundle\Eav\Domain\Interfaces\Repositories;

use Untek\Bundle\Eav\Domain\Entities\EntityEntity;
use Untek\Domain\Repository\Interfaces\CrudRepositoryInterface;
use Untek\Domain\Query\Entities\Query;

interface EntityRepositoryInterface extends CrudRepositoryInterface
{

    public function findOneByName(string $name, Query $query = null): EntityEntity;
}
