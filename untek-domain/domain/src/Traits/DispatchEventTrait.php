<?php

namespace Untek\Model\Shared\Traits;

use Untek\Model\Shared\Events\EntityEvent;
use Untek\Model\Shared\Events\QueryEvent;
use Untek\Core\EventDispatcher\Traits\EventDispatcherTrait;
use Untek\Model\Query\Entities\Query;

trait DispatchEventTrait
{

    use EventDispatcherTrait;

    protected function dispatchQueryEvent(Query $query, string $eventName): QueryEvent
    {
        $event = new QueryEvent($query);
        $this->getEventDispatcher()->dispatch($event, $eventName);
        return $event;
    }

    protected function dispatchEntityEvent(object $entity, string $eventName): EntityEvent
    {
        $event = new EntityEvent($entity);
        $this->getEventDispatcher()->dispatch($event, $eventName);
        return $event;
    }
}
