<?php

return [
    'definitions' => [],
    'singletons' => [
        'ZnDatabase\Migration\Domain\Interfaces\Services\GenerateServiceInterface' => 'ZnDatabase\Migration\Domain\Services\GenerateService',
        'ZnDatabase\Migration\Domain\Interfaces\Repositories\GenerateRepositoryInterface' => 'ZnDatabase\Migration\Domain\Repositories\File\GenerateRepository',
    ],
];
