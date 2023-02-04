<?php

namespace Untek\Bundle\Dashboard;

use Untek\Core\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'dashboard';
    }

    public function symfonyAdmin(): array
    {
        return [
            __DIR__ . '/Symfony4/Web/config/routing.php',
        ];
    }

    public function symfonyWeb(): array
    {
        return [
            __DIR__ . '/Symfony4/Web/config/routing.php',
        ];
    }

    public function i18next(): array
    {
        return [
            'dashboard' => __DIR__ . '/Domain/i18next/__lng__/__ns__.json',
        ];
    }

    public function migration(): array
    {
        return [

        ];
    }

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
