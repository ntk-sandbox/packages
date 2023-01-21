<?php

namespace ZnCore\App\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\EventDispatcher\Event;
use ZnCore\App\Enums\AppEventEnum;
use ZnCore\Container\Traits\ContainerAwareTrait;
use ZnCore\Env\Helpers\PhpErrorHelper;

class PhpErrorSubscriber implements EventSubscriberInterface
{

    use ContainerAwareTrait;

    public static function getSubscribedEvents(): array
    {
        return [
            AppEventEnum::AFTER_INIT_ENV => 'onAfterInit',
        ];
    }

    public function onAfterInit(Event $event, string $eventName)
    {
        PhpErrorHelper::setErrorVisible(boolval(getenv('APP_DEBUG')));
    }
}
