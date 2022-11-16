<?php

namespace ZnFramework\Telegram;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function console(): array
    {
        return [
            'ZnFramework\Telegram\Symfony4\Commands',
        ];
    }

    public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
            __DIR__ . '/Domain/config/container-script.php',
        ];
    }
}
