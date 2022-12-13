<?php

namespace ZnSandbox\Sandbox\Person2\Domain\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use ZnCore\Contract\Common\Exceptions\ReadOnlyException;
use ZnCore\Contract\User\Exceptions\ForbiddenException;
use ZnDomain\Domain\Enums\EventEnum;
use ZnDomain\Domain\Events\EntityEvent;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\EntityManager\Traits\EntityManagerAwareTrait;
use ZnSandbox\Sandbox\Person2\Domain\Entities\PersonEntity;
use ZnSandbox\Sandbox\Person2\Domain\Interfaces\Services\MyPersonServiceInterface;

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
