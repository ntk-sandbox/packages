<?php

namespace Untek\Bundle\Queue\Domain\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\EventDispatcher\Event;
use Untek\Bundle\Queue\Domain\Interfaces\Services\JobServiceInterface;
use Untek\Core\App\Enums\AppEventEnum;
use Untek\Core\Container\Helpers\ContainerHelper;
use Untek\Framework\Console\Domain\Libs\ZnShell;

/**
 * Автозапуск CRON-задач при каждом запросе.
 *
 * Конфигурация в dotEnv по имени "CRON_AUTORUN".
 * Значения: 0/1
 */
class AutorunQueueSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            AppEventEnum::AFTER_INIT_DISPATCHER => 'onAfterInit',
        ];
    }

    public function callbackWithShell()
    {
        $shell = new ZnShell();
        $process = $shell->getProcessFromCommandString('queue:run');
//            $process->run();
        $process->start();
        $process->disableOutput();
        while ($process->isRunning()) {
        }
    }

    public function callbackWithService()
    {
        /** @var JobServiceInterface $jobService */
        $jobService = ContainerHelper::getContainer()->get(JobServiceInterface::class);
        try {
            $jobService->touch();
        } catch (\Throwable  $e) {
        }
    }

    public function onAfterInit(Event $event)
    {
        register_shutdown_function([$this, 'callbackWithService']);
    }
}
