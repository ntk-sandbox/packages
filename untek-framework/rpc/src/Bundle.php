<?php

namespace Untek\Framework\Rpc;

use Untek\Core\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'rpc';
    }

    public function symfonyRpc(): array
    {
        return [
            __DIR__ . '/Rpc/config/fixture-routes.php',
            __DIR__ . '/Rpc/config/settings-routes.php',
            __DIR__ . '/Rpc/config/method-routes.php',
        ];
    }

    public function symfonyWeb(): array
    {
        return [
            __DIR__ . '/Symfony4/Web/config/routing.php',
        ];
    }

    /*public function i18next(): array
    {
        return [

        ];
    }*/

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
            __DIR__ . '/Domain/config/container-script.php',
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
