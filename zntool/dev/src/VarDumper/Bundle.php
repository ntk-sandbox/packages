<?php

namespace ZnTool\Dev\VarDumper;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function eventDispatcher(): array
    {
        return [
            __DIR__ . '/config/eventDispatcher.php',
        ];
    }
}
