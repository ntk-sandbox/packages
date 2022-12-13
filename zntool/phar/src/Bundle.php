<?php

namespace ZnTool\Phar;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'phar';
    }

    public function console(): array
    {
        return [
            'ZnTool\Phar\Commands',
        ];
    }
}
