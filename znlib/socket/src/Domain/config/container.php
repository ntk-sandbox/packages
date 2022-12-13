<?php

use ZnLib\Socket\Domain\Repositories\Ram\ConnectionRepository;

return [
    'singletons' => [
        ConnectionRepository::class => ConnectionRepository::class,
    ],
];
