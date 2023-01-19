<?php

use ZnSandbox\Sandbox\Apache\Domain\Repositories\Conf\HostsRepository;
use ZnSandbox\Sandbox\Apache\Domain\Repositories\Conf\ServerRepository;

return [
    'definitions' => [],
    'singletons' => [
        ServerRepository::class => function () {
            return new ServerRepository(getenv('HOST_CONF_DIR'), new HostsRepository());
        },
    ],
];
