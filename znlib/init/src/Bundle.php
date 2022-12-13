<?php

namespace ZnLib\Init;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'init';
    }

    public function console(): array
    {
        return [
            'ZnLib\Init\Symfony4\Console\Commands',
        ];
    }
}
