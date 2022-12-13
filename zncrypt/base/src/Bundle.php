<?php

namespace ZnCrypt\Base;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'crypt_base';
    }

    public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container-new.php',
        ];
    }
}
