<?php

namespace Untek\User\Notify;

use Untek\Core\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'userNotify';
    }

    public function i18next(): array
    {
        return [
            'user.notify' => __DIR__ . '/Domain/i18next/__lng__/__ns__.json',
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
