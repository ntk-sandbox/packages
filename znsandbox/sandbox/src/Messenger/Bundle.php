<?php

namespace ZnSandbox\Sandbox\Messenger;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'messenger';
    }

    public function console(): array
    {
        return [
            'ZnSandbox\Sandbox\Messenger\Commands',
        ];
    }
}
