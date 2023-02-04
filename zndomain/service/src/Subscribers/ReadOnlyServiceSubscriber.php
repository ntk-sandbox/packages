<?php

namespace Untek\Domain\Service\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Untek\Core\Contract\Common\Exceptions\ReadOnlyException;
use Untek\Domain\Domain\Enums\EventEnum;
use Untek\Domain\Domain\Events\EntityEvent;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\EntityManager\Traits\EntityManagerAwareTrait;

class ReadOnlyServiceSubscriber implements EventSubscriberInterface
{

    use EntityManagerAwareTrait;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->setEntityManager($entityManager);
    }

    public static function getSubscribedEvents()
    {
        return [
            EventEnum::BEFORE_CREATE_ENTITY => 'onBefore',
            EventEnum::BEFORE_UPDATE_ENTITY => 'onBefore',
            EventEnum::BEFORE_DELETE_ENTITY => 'onBefore',
        ];
    }

    public function onBefore(EntityEvent $event)
    {
        throw new ReadOnlyException('Service readonly');
    }
}
