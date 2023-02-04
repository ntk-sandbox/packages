<?php

namespace Untek\User\Authentication;

use Untek\Core\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'userAuthentication';
    }

    public function symfonyRpc(): array
    {
        return [
            __DIR__ . '/Rpc/config/account-routes.php',
            __DIR__ . '/Rpc/config/auth-identity-routes.php',
            __DIR__ . '/Rpc/config/imitation-auth-routes.php',
        ];
    }

    public function symfonyWeb(): array
    {
        return [
            __DIR__ . '/Symfony4/Web/config/routing.php',
        ];
    }

    public function symfonyAdmin(): array
    {
        return [
            __DIR__ . '/Symfony4/Web/config/routing.php',
        ];
    }

    public function i18next(): array
    {
        return [
            'authentication' => __DIR__ . '/Domain/i18next/__lng__/__ns__.json',
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
            __DIR__ . '/Domain/config/container-script.php',
        ];
    }

    public function eventDispatcher(): array
    {
        return [
            __DIR__ . '/Domain/config/eventDispatcher.php',
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
