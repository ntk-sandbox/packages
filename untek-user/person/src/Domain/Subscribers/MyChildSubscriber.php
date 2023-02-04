<?php

namespace Untek\User\Person\Domain\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Untek\Domain\Domain\Enums\EventEnum;
use Untek\Domain\Domain\Events\EntityEvent;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\EntityManager\Traits\EntityManagerAwareTrait;
use Untek\User\Person\Domain\Interfaces\Services\MyPersonServiceInterface;

class MyChildSubscriber implements EventSubscriberInterface
{

    use EntityManagerAwareTrait;

    private $myPersonService;

    public function __construct(EntityManagerInterface $entityManager, MyPersonServiceInterface $myPersonService)
    {
        $this->setEntityManager($entityManager);
        $this->myPersonService = $myPersonService;
    }

    public static function getSubscribedEvents()
    {
        return [
            EventEnum::BEFORE_UPDATE_ENTITY => 'onBefore',
            EventEnum::BEFORE_DELETE_ENTITY => 'onBefore',
        ];
    }

    public function onBefore(EntityEvent $event)
    {
        if (!$this->myPersonService->isMyChild($event->getEntity()->getId())) {
            throw new AccessDeniedException('Not allowed');
        }
    }
}
