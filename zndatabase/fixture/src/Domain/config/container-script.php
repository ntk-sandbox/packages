<?php

use Untek\Database\Fixture\Domain\Repositories\FileRepository;
use Untek\Lib\Components\Store\Helpers\StoreHelper;
use Untek\Core\App\Interfaces\EnvStorageInterface;

return [
    'definitions' => [],
    'singletons' => [
        FileRepository::class => function (\Psr\Container\ContainerInterface $container) {
            /** @var \Untek\Core\App\Interfaces\EnvStorageInterface $envStorage */
            $envStorage = $container->get(\Untek\Core\App\Interfaces\EnvStorageInterface::class);

            $config = StoreHelper::load($envStorage->get('FIXTURE_CONFIG_FILE'));
            return new FileRepository($config);
        },
    ],
];
