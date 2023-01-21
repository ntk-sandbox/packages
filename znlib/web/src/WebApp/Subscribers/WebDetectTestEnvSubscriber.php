<?php

namespace ZnLib\Web\WebApp\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\EventDispatcher\Event;
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
        $envDetector = new WebEnvDetector();
        $isTest = $envDetector->isTest();
        if ($isTest) {
//            $_ENV['APP_ENV'] = 'test';
//            putenv("APP_ENV=test");
//            $this->configManager->set('APP_ENV', 'test');
        }
        $mode = $isTest ? 'test' : 'main';
//        $_ENV['APP_MODE'] = $mode;
//        putenv("APP_MODE={$mode}");
        $event->getApp()->setMode($mode);
//        $this->configManager->set('APP_MODE', $mode);
    }
}
