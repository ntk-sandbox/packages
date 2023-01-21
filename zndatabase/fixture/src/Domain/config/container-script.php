<?php

use ZnDatabase\Fixture\Domain\Repositories\FileRepository;
use ZnLib\Components\Store\Helpers\StoreHelper;
use ZnCore\App\Interfaces\EnvStorageInterface;

return [
    'definitions' => [],
    'singletons' => [
        FileRepository::class => function (\Psr\Container\ContainerInterface $container) {
            /** @var \ZnCore\App\Interfaces\EnvStorageInterface $envStorage */
            $envStorage = $container->get(\ZnCore\App\Interfaces\EnvStorageInterface::class);

            $config = StoreHelper::load($envStorage->get('FIXTURE_CONFIG_FILE'));
            return new FileRepository($config);
        },
    ],
];
