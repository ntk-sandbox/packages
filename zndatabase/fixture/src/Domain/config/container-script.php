<?php

use ZnDatabase\Fixture\Domain\Repositories\FileRepository;
use ZnLib\Components\Store\Helpers\StoreHelper;

return [
    'definitions' => [],
    'singletons' => [
        FileRepository::class => function () {
            $config = StoreHelper::load(getenv('FIXTURE_CONFIG_FILE'));
            return new FileRepository($config);
        },
    ],
];
