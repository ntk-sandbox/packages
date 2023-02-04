<?php

namespace Untek\Sandbox\Sandbox\RpcMock;

use Untek\Core\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'rpc-mock';
    }

    public function deps(): array
    {
        return [
            new \Untek\Framework\Rpc\Bundle(['all']),
        ];
    }

    public function symfonyRpc(): array
    {
        return [
            __DIR__ . '/Rpc/config/handle-routes.php',
            __DIR__ . '/Rpc/config/method-routes.php',
        ];
    }
    
    public function migration(): array
    {
        return [
            __DIR__ . '/Domain/Migrations',
        ];
    }

    public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
        ];
    }

    public function entityManager(): array
    {
        return [
            __DIR__ . '/Domain/config/em.php',
        ];
    }

    public function eventDispatcher(): array
    {
        return [
            __DIR__ . '/Domain/config/eventDispatcher.php',
        ];
    }

    public function rbac(): array
    {
        return [
            __DIR__ . '/Domain/config/rbac.php',
        ];
    }
}
