<?php

namespace ZnKaz\Eds;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'eds';
    }

    public function console(): array
    {
        return [
            'ZnKaz\Eds\Commands',
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
