<?php

use Untek\Lib\Socket\Domain\Repositories\Ram\ConnectionRepository;

return [
    'singletons' => [
        ConnectionRepository::class => ConnectionRepository::class,
    ],
];
