<?php

namespace Untek\Domain\Domain\Traits;

use Untek\Domain\Domain\Enums\EventEnum;
use Untek\Domain\Query\Entities\Query;

trait ForgeQueryTrait
{

    protected function forgeQuery(Query $query = null): Query
    {
        $query = Query::forge($query);
        $this->dispatchQueryEvent($query, EventEnum::BEFORE_FORGE_QUERY);
        return $query;
    }
}
