<?php

namespace Untek\Model\Shared\Traits;

use Untek\Model\Shared\Enums\EventEnum;
use Untek\Model\Query\Entities\Query;

trait ForgeQueryTrait
{

    protected function forgeQuery(Query $query = null): Query
    {
        $query = Query::forge($query);
        $this->dispatchQueryEvent($query, EventEnum::BEFORE_FORGE_QUERY);
        return $query;
    }
}
