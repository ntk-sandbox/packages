<?php

namespace ZnLib\Components\Lock;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function container(): array
    {
        return [
            __DIR__ . '/config/container-script.php',
        ];
    }
}
