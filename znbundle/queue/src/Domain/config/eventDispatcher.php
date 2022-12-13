<?php

use ZnBundle\Queue\Domain\Subscribers\AutorunQueueSubscriber;
use ZnCore\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;

return function (EventDispatcherConfiguratorInterface $configurator): void {

    /** Подключаем автозапуск CRON-задач при каждом запросе */
    $configurator->addSubscriber(AutorunQueueSubscriber::class);
};
