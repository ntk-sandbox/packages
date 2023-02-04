<?php

namespace Untek\Framework\Wsdl;

use Untek\Core\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'wsdl';
    }

    public function symfonyWeb(): array
    {
        return [
            __DIR__ . '/Symfony/Web/config/routing.php',
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
}
