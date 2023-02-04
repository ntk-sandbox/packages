<?php

namespace Untek\Database\Eloquent;

use Untek\Core\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'databaseEloquent';
    }

    public function deps(): array
    {
        return [
            \Untek\Database\Base\Bundle::class,
        ];
    }

    public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
        ];
    }
}
