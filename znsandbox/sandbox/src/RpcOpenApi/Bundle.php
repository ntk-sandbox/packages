<?php

namespace ZnSandbox\Sandbox\RpcOpenApi;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'rpcOpenApi';
    }

    public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
        ];
    }

    public function eventDispatcher(): array
    {
        return [
            __DIR__ . '/Domain/config/eventDispatcher.php',
        ];
    }
}
