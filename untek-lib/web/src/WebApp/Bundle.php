<?php

namespace Untek\Lib\Web\WebApp;

use Untek\Core\Bundle\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'webApp';
    }

    public function deps(): array
    {
        return [
            \Untek\Lib\Web\Form\Bundle::class,
            \Untek\Lib\Web\View\Bundle::class,
            \Untek\Lib\Web\Layout\Bundle::class,
        ];
    }

    public function container(): array
    {
        return [
            __DIR__ . '/config/container.php',
        ];
    }
}
