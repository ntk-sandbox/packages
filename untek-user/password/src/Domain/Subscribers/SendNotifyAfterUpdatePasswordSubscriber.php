<?php

namespace Untek\User\Password\Domain\Subscribers;

use Untek\User\Password\Domain\Enums\UserActionEventEnum;
use Untek\User\Identity\Domain\Events\UserActionEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Untek\Model\EntityManager\Traits\EntityManagerAwareTrait;
use Untek\User\Notify\Domain\Interfaces\Services\NotifyServiceInterface;
use Untek\User\Password\Domain\Enums\UserSecurityNotifyTypeEnum;

class SendNotifyAfterUpdatePasswordSubscriber implements EventSubscriberInterface
{

    use EntityManagerAwareTrait;

    private $notifyService;

    public function __construct(
        NotifyServiceInterface $notifyService
    )
    {
        $this->notifyService = $notifyService;
    }

    public static function getSubscribedEvents()
    {
        return [
            UserActionEventEnum::AFTER_UPDATE_PASSWORD => 'onAfterUpdatePassword',
        ];
    }

    public function onAfterUpdatePassword(UserActionEvent $event)
    {
        $this->notifyService->sendNotifyByTypeName(UserSecurityNotifyTypeEnum::UPDATE_PASSWORD, $event->getIdentityId());
    }
}
