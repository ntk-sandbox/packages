<?php

namespace ZnSandbox\Sandbox\WebTest;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function console(): array
    {
        return [
            'ZnSandbox\Sandbox\WebTest\Commands',
        ];
    }
}
