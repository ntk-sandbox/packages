<?php

namespace Untek\Domain\Query\Helpers;

use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Domain\Query\Entities\Query;

class QueryHelper
{

    public static function extractOneCondition(Query $query, string $name, $default = null)
    {
        $all = self::extractAllConditions($query);
        return ArrayHelper::getValue($all, $name, $default);
    }

    public static function extractAllConditions(Query $query): ?array
    {
        if (!$query->getWhere()) {
            return null;
        }
        $conditions = [];
        foreach ($query->getWhere() as $where) {
            $conditions[$where->column] = $where->value;
        }
        return $conditions;
    }
}
