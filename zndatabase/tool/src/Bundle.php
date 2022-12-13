<?php

namespace ZnDatabase\Tool;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'databaseTool';
    }

    public function console(): array
    {
        return [
            'ZnDatabase\Tool\Commands',
        ];
    }
}
