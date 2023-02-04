<?php

namespace Untek\User\Registration;

use Untek\Core\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'userRegistration';
    }

    public function i18next(): array
    {
        return [
            'user.registration' => __DIR__ . '/Domain/i18next/__lng__/__ns__.json',
        ];
    }

    public function symfonyRpc(): array
    {
        return [
            __DIR__ . '/Rpc/config/routes.php',
        ];
    }

    /*public function symfonyWeb(): array
    {
        return [
            __DIR__ . '/Symfony4/Web/config/routing.php',
        ];
    }*/

    public function rbac(): array
    {
        return [
            __DIR__ . '/Domain/config/rbac.php',
        ];
    }

    public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
        ];
    }
}
