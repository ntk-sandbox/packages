<?php

namespace Untek\Tool\Dev\VarDumper;

use Untek\Core\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'varDumper';
    }

    public function eventDispatcher(): array
    {
        return [
            __DIR__ . '/config/eventDispatcher.php',
        ];
    }
}
