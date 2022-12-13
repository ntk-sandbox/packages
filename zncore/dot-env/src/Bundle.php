<?php

namespace ZnCore\DotEnv;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'dotEnv';
    }

    public function console(): array
    {
        return [
            __DIR__ . '/../../../../../../vendor/symfony/dotenv/Command',
        ];
    }

    public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
        ];
    }
}
