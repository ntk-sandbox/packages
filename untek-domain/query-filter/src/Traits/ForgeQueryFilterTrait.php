<?php

namespace Untek\Model\QueryFilter\Traits;

use Psr\EventDispatcher\EventDispatcherInterface;
use Untek\Model\Shared\Enums\EventEnum;
use Untek\Model\Shared\Events\QueryEvent;
use Untek\Model\Query\Entities\Query;
use Untek\Model\QueryFilter\Helpers\FilterModelHelper;

trait ForgeQueryFilterTrait
{

    abstract protected function getEventDispatcher(): EventDispatcherInterface;

    public function forgeQueryByFilter(object $filterModel, Query $query)
    {
        FilterModelHelper::validate($filterModel);
        FilterModelHelper::forgeOrder($query, $filterModel);
        $query = $this->forgeQuery($query);
        $event = new QueryEvent($query);
        $event->setFilterModel($filterModel);
        $this
            ->getEventDispatcher()
            ->dispatch($event, EventEnum::BEFORE_FORGE_QUERY_BY_FILTER);
        $schema = $this->getSchema();
        $columnList = $schema->getColumnListing($this->tableNameAlias());
        FilterModelHelper::forgeCondition($query, $filterModel, $columnList);
    }
}
