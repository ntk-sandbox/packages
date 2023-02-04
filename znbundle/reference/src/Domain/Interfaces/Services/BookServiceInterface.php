<?php

namespace Untek\Bundle\Reference\Domain\Interfaces\Services;

use Untek\Bundle\Reference\Domain\Entities\BookEntity;
use Untek\Domain\Service\Interfaces\CrudServiceInterface;
use Untek\Domain\Query\Entities\Query;

interface BookServiceInterface extends CrudServiceInterface
{

    public function findOneByName(string $name, Query $query = null): BookEntity;
}
