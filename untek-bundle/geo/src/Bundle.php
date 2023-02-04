<?php

namespace Untek\Bundle\Geo;

use Untek\Core\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'geo';
    }

    public function symfonyRpc(): array
    {
        return [
            __DIR__ . '/Rpc/config/country-routes.php',
            __DIR__ . '/Rpc/config/currency-routes.php',
            __DIR__ . '/Rpc/config/locality-routes.php',
            __DIR__ . '/Rpc/config/region-routes.php',
        ];
    }

    public function i18next(): array
    {
        return [
            'geo' => __DIR__ . '/Domain/i18next/__lng__/__ns__.json',
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
