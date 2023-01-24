<?php

namespace ZnLib\Web\WebApp\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use ZnCore\App\Enums\AppEventEnum;
use ZnCore\App\Events\AppEvent;
use ZnLib\Web\WebApp\Libs\EnvDetector\WebEnvDetector;

class WebDetectTestEnvSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            AppEventEnum::BEFORE_INIT_ENV => 'onBeforeInitEnv',
        ];
    }

    public function onBeforeInitEnv(AppEvent $event)
    {
        $request = $event->getApp()->getRequest();
        $envDetector = new WebEnvDetector($request);
        $isTest = $envDetector->isTest();
        $mode = $isTest ? 'test' : 'main';
        $event->getApp()->setMode($mode);
    }
}
