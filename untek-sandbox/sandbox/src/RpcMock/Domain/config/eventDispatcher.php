<?php

use Untek\Core\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use Untek\Sandbox\Sandbox\RpcMock\Domain\Subscribers\CreateRpcMockSubscriber;

return function (EventDispatcherConfiguratorInterface $configurator): void {
    if (getenv('RPC_MOCK_ENABLED')) {
        $configurator->addSubscriber(CreateRpcMockSubscriber::class); // Сохранять запрос как Mock при отсутсвии
    }
};
