<?php

namespace Untek\Domain\Components\ArrayRepository\Helpers;

use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Expr\Comparison;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Core\Collection\Libs\Collection;
use Untek\Domain\Query\Entities\Query;

class FilterHelper
{

    public static function filterItems(array $items, Query $query): array
    {
        $collection = new Collection($items);
        $collection = self::filterByQuery($collection, $query);
        return $collection->toArray();
    }

    public static function filterByQuery(Enumerable $collection, Query $query): Enumerable
    {
        $criteria = self::query2criteria($query);
        return $collection->matching($criteria);
    }

    public static function query2criteria(Query $query): Criteria
    {
        $criteria = new Criteria();
        if ($query->getWhere()) {
            foreach ($query->getWhere() as $where) {
                $expr = new Comparison($where->column, $where->operator, $where->value);
                $criteria->andWhere($expr);
            }
        }
        return $criteria;
    }
}
