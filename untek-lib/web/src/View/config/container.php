<?php

use Untek\Component\Web\View\Libs\View;
use Untek\Component\Web\View\Resources\Css;
use Untek\Component\Web\View\Resources\Js;

return [
    'singletons' => [
        View::class => View::class,
        Css::class => Css::class,
        Js::class => Js::class,
    ],
];
