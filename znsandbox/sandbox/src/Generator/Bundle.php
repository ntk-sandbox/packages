<?php

namespace ZnSandbox\Sandbox\Generator;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function deps(): array
    {
        return [
            new \ZnSandbox\Sandbox\Bundle\Bundle(['all'])
        ];
    }

    public function console(): array
    {
        return [
            'ZnSandbox\Sandbox\Generator\Commands',
        ];
    }

    public function symfonyAdmin(): array
    {
        return [
            __DIR__ . '/Symfony4/Admin/config/routing.php',
        ];
    }

    /*public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
        ];
    }*/
}
