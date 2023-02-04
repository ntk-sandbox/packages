<?php

use Untek\Sandbox\Sandbox\Apache\Domain\Repositories\Conf\HostsRepository;
use Untek\Sandbox\Sandbox\Apache\Domain\Repositories\Conf\ServerRepository;

return [
    'definitions' => [],
    'singletons' => [
        ServerRepository::class => function (\Psr\Container\ContainerInterface $container) {
            /** @var \Untek\Core\App\Interfaces\EnvStorageInterface $envStorage */
            $envStorage = $container->get(\Untek\Core\App\Interfaces\EnvStorageInterface::class);

            return new ServerRepository($envStorage->get('HOST_CONF_DIR'), new HostsRepository());
        },
    ],
];
