<?php

return [
    'definitions' => [

    ],
    'singletons' => [
        \Untek\Tool\Generator\Domain\Interfaces\Services\DomainServiceInterface::class => \Untek\Tool\Generator\Domain\Services\DomainService::class,
        \Untek\Tool\Generator\Domain\Interfaces\Services\ModuleServiceInterface::class => \Untek\Tool\Generator\Domain\Services\ModuleService::class,
    ],
];
