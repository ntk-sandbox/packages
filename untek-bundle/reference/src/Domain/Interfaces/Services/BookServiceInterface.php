<?php

namespace Untek\Bundle\Reference\Domain\Interfaces\Services;

use Untek\Bundle\Reference\Domain\Entities\BookEntity;
use Untek\Model\Service\Interfaces\CrudServiceInterface;
use Untek\Model\Query\Entities\Query;

interface BookServiceInterface extends CrudServiceInterface
{

    public function findOneByName(string $name, Query $query = null): BookEntity;
}
