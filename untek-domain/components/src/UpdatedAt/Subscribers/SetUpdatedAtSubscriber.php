<?php

namespace Untek\Domain\Components\UpdatedAt\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Untek\Domain\Domain\Enums\EventEnum;
use Untek\Domain\Domain\Events\EntityEvent;

class SetUpdatedAtSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
//            EventEnum::BEFORE_CREATE_ENTITY => 'onBeforePersist',
            EventEnum::BEFORE_UPDATE_ENTITY => 'onBeforePersist',
        ];
    }

    public function onBeforePersist(EntityEvent $event)
    {
        $entity = $event->getEntity();
        $entity->setUpdatedAt(new \DateTime());
    }
}
