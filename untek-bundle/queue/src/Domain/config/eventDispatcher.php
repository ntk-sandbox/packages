<?php

use Untek\Bundle\Queue\Domain\Subscribers\AutorunQueueSubscriber;
use Untek\Core\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;

return function (EventDispatcherConfiguratorInterface $configurator): void {

    /** Подключаем автозапуск CRON-задач при каждом запросе */
    $configurator->addSubscriber(AutorunQueueSubscriber::class);
};
