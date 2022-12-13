<?php

namespace ZnLib\Socket;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'webSocket';
    }

    public function console(): array
    {
        return [
            'ZnLib\Socket\Symfony4\Commands',
        ];
    }

    public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
        ];
    }
}
