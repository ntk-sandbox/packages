<?php

namespace Untek\Framework\Console\Domain\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Untek\Core\App\Enums\AppEventEnum;
use Untek\Core\App\Events\AppEvent;
use Untek\Framework\Console\Domain\Libs\EnvDetector\ConsoleEnvDetector;

class ConsoleDetectTestEnvSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            AppEventEnum::BEFORE_INIT_ENV => 'onBeforeInitEnv',
        ];
    }

    public function onBeforeInitEnv(AppEvent $event)
    {
        $envDetector = new ConsoleEnvDetector();
        $isTest = $envDetector->isTest();
        $mode = $isTest ? 'test' : 'main';
        $event->getApp()->setMode($mode);
    }
}
