<?php

namespace Untek\Sandbox\Sandbox\Apache;

use Untek\Core\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'apache';
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
            'user' => 'zn/untek-bundle/user/src/Domain/i18next/__lng__/__ns__.json',
        ];
    }

    public function migration(): array
    {
        return [
          __DIR__ . '/Domain/Migrations',
        ];
    }*/

    public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
        ];
    }
}
