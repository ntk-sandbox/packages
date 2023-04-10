<?php

namespace Untek\Component\Web\WebApp;

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
            \Untek\Component\Web\Form\Bundle::class,
            \Untek\Component\Web\View\Bundle::class,
            \Untek\Component\Web\Layout\Bundle::class,
        ];
    }

    public function container(): array
    {
        return [
            __DIR__ . '/config/container.php',
        ];
    }
}
