<?php

namespace ZnDomain\Repository\Traits;

use ZnCore\Collection\Interfaces\Enumerable;
use ZnDomain\Query\Entities\Query;

trait CrudRepositoryFindAllTrait
{

    public function findAll(Query $query = null): Enumerable
    {
        $query = $this->forgeQuery($query);
        $collection = $this->findBy($query);
        $this->loadRelationsByQuery($collection, $query);
        return $collection;
    }
}
