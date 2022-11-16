<?php

use ZnCore\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use ZnSandbox\Sandbox\RpcMock\Domain\Subscribers\CreateRpcMockSubscriber;

return function (EventDispatcherConfiguratorInterface $configurator): void {
    $configurator->addSubscriber(CreateRpcMockSubscriber::class); // Сохранять запрос как Mock при отсутсвии
};
