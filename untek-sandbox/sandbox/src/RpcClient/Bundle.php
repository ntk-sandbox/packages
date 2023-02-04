<?php

namespace Untek\Sandbox\Sandbox\RpcClient;

use Untek\Core\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'rpc-client';
    }

    public function deps(): array
    {
        return [
            new \Untek\Framework\Rpc\Bundle(['all']),
        ];
    }

    public function symfonyWeb(): array
    {
        return [
            __DIR__ . '/Symfony4/Admin/config/routing.php',
        ];
    }

    public function symfonyAdmin(): array
    {
        return [
            __DIR__ . '/Symfony4/Admin/config/routing.php',
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

    public function rbac(): array
    {
        return [
            __DIR__ . '/Domain/config/rbac.php',
        ];
    }
}
