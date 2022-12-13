<?php

namespace ZnBundle\Reference;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'reference';
    }

    public function symfonyRpc(): array
    {
        return [
            __DIR__ . '/Rpc/config/item-routes.php',
            __DIR__ . '/Rpc/config/book-routes.php',
        ];
    }
    
    public function rbac(): array
    {
        return [
            __DIR__ . '/Domain/config/rbac.php',
        ];
    }

    public function i18next(): array
    {
        return [
            'reference' => __DIR__ . '/Domain/i18next/__lng__/__ns__.json',
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
}
