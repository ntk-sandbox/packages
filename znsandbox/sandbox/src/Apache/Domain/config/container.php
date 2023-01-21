<?php

use ZnSandbox\Sandbox\Apache\Domain\Repositories\Conf\HostsRepository;
use ZnSandbox\Sandbox\Apache\Domain\Repositories\Conf\ServerRepository;

return [
    'definitions' => [],
    'singletons' => [
        ServerRepository::class => function (\Psr\Container\ContainerInterface $container) {
            /** @var \ZnCore\App\Interfaces\EnvStorageInterface $envStorage */
            $envStorage = $container->get(\ZnCore\App\Interfaces\EnvStorageInterface::class);

            return new ServerRepository($envStorage->get('HOST_CONF_DIR'), new HostsRepository());
        },
    ],
];
