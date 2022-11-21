<?php

use ZnCore\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use ZnSandbox\Sandbox\RpcMock\Domain\Subscribers\CreateRpcMockSubscriber;

return function (EventDispatcherConfiguratorInterface $configurator): void {
    if (!empty($_ENV['RPC_MOCK_ENABLED'])) {
        $configurator->addSubscriber(CreateRpcMockSubscriber::class); // Сохранять запрос как Mock при отсутсвии
    }
};
