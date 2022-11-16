<?php

namespace ZnDomain\Domain\Traits;

use ZnDomain\Domain\Enums\EventEnum;
use ZnDomain\Query\Entities\Query;

trait ForgeQueryTrait
{

    protected function forgeQuery(Query $query = null): Query
    {
        $query = Query::forge($query);
        $this->dispatchQueryEvent($query, EventEnum::BEFORE_FORGE_QUERY);
        return $query;
    }
}
