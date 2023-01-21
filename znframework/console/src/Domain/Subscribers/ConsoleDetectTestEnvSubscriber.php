<?php

namespace ZnFramework\Console\Domain\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\EventDispatcher\Event;
use ZnCore\App\Enums\AppEventEnum;
use ZnCore\App\Events\AppEvent;
use ZnFramework\Console\Domain\Libs\EnvDetector\ConsoleEnvDetector;

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
