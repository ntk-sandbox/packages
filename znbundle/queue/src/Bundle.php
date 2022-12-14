<?php

namespace ZnBundle\Queue;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'queue';
    }

    public function deps(): array
    {
        return [
            new \ZnLib\Components\Lock\Bundle(['all']),
        ];
    }

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

    public function eventDispatcher(): array
    {
        return [
            __DIR__ . '/Domain/config/eventDispatcher.php',
        ];
    }
}
