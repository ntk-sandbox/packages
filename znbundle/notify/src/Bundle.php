<?php

namespace ZnBundle\Notify;

use ZnCore\Bundle\Base\BaseBundle;

// todo: отделить flash, toastr
class Bundle extends BaseBundle
{

    public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
        ];
    }
}
