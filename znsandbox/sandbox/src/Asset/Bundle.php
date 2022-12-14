<?php

namespace ZnSandbox\Sandbox\Asset;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'webAsset';
    }

    public function symfonyWeb(): array
    {
        return [
            __DIR__ . '/Symfony4/Web/config/routing.php',
        ];
    }
}
