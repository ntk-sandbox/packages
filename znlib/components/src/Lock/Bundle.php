<?php

namespace ZnLib\Components\Lock;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'lock';
    }

    public function container(): array
    {
        return [
            __DIR__ . '/config/container-script.php',
        ];
    }
}
