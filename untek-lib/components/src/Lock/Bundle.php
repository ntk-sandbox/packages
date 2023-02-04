<?php

namespace Untek\Lib\Components\Lock;

use Untek\Core\Bundle\Base\BaseBundle;

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
