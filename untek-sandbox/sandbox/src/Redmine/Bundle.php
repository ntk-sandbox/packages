<?php

namespace Untek\Sandbox\Sandbox\Redmine;

use Untek\Core\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'redmine';
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
