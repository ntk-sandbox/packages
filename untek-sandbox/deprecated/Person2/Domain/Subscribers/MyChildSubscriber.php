<?php

namespace Untek\Sandbox\Sandbox\Person2\Domain\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Untek\Core\Contract\Common\Exceptions\ReadOnlyException;
use Untek\Core\Contract\User\Exceptions\ForbiddenException;
use Untek\Model\Shared\Enums\EventEnum;
use Untek\Model\Shared\Events\EntityEvent;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\EntityManager\Traits\EntityManagerAwareTrait;
use Untek\Sandbox\Sandbox\Person2\Domain\Entities\PersonEntity;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Services\MyPersonServiceInterface;

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
            throw new ForbiddenException('Not allowed');
        }
    }
}
