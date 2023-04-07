<?php

namespace Untek\Model\Service\Traits;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Model\DataProvider\Libs\DataProvider;
use Untek\Model\Query\Entities\Query;

trait CrudServiceFindAllTrait
{

    public function getDataProvider(Query $query = null): DataProvider
    {
        $dataProvider = new DataProvider($this, $query);
        return $dataProvider;
    }

    public function findAll(Query $query = null): Enumerable
    {
        $query = $this->forgeQuery($query);
        $collection = $this->getRepository()->findAll($query);
        return $collection;
    }

    public function count(Query $query = null): int
    {
        $query = $this->forgeQuery($query);
        return $this->getRepository()->count($query);
    }
}
