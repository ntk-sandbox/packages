<?php

namespace ZnBundle\Queue;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    /*public function i18next(): array
    {
        return [
            
        ];
    }*/

    public function console(): array
    {
        return [
            'ZnBundle\Queue\Symfony4\Commands',
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
