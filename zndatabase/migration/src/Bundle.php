<?php

namespace ZnDatabase\Migration;

use ZnCore\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'databaseMigration';
    }

    public function console(): array
    {
        return [
            'ZnDatabase\Migration\Commands',
        ];
    }

    public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
        ];
    }
}
