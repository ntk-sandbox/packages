<?php

use ZnCore\Env\Helpers\EnvHelper;

return [
    'singletons' => [
        'ZnBundle\\Language\\Domain\\Interfaces\\Services\\LanguageServiceInterface' => 'ZnBundle\\Language\\Domain\\Services\\LanguageService',
        'ZnBundle\\Language\\Domain\\Interfaces\\Services\\RuntimeLanguageServiceInterface' => 'ZnBundle\\Language\\Domain\\Services\\RuntimeLanguageService',
        'ZnBundle\\Language\\Domain\\Interfaces\\Repositories\\LanguageRepositoryInterface' => 'ZnBundle\\Language\\Domain\\Repositories\\Eloquent\\LanguageRepository',
        'ZnBundle\\Language\\Domain\\Interfaces\\Repositories\\SwitchRepositoryInterface' => EnvHelper::isConsole() ? 'ZnBundle\\Language\\Domain\\Repositories\\Console\\SwitchRepository' : 'ZnBundle\\Language\\Domain\\Repositories\\Symfony4\\SwitchRepository',
        'ZnBundle\\Language\\Domain\\Interfaces\\Repositories\\StorageRepositoryInterface' => EnvHelper::isConsole() ? 'ZnBundle\\Language\\Domain\\Repositories\\Console\\StorageRepository' : 'ZnBundle\\Language\\Domain\\Repositories\\Symfony4\\StorageRepository',
        'ZnBundle\\Language\\Domain\\Interfaces\\Services\\BundleServiceInterface' => 'ZnBundle\\Language\\Domain\\Services\\BundleService',
        'ZnBundle\\Language\\Domain\\Interfaces\\Repositories\\BundleRepositoryInterface' => 'ZnBundle\\Language\\Domain\\Repositories\\Eloquent\\BundleRepository',
        'ZnBundle\\Language\\Domain\\Interfaces\\Services\\TranslateServiceInterface' => 'ZnBundle\\Language\\Domain\\Services\\TranslateService',
        'ZnBundle\\Language\\Domain\\Interfaces\\Repositories\\TranslateRepositoryInterface' => 'ZnBundle\\Language\\Domain\\Repositories\\Eloquent\\TranslateRepository',
    ],
    /*'entities' => [
        'ZnBundle\\Language\\Domain\\Entities\\BundleEntity' => 'ZnBundle\\Language\\Domain\\Interfaces\\Repositories\\BundleRepositoryInterface',
        'ZnBundle\\Language\\Domain\\Entities\\TranslateEntity' => 'ZnBundle\\Language\\Domain\\Interfaces\\Repositories\\TranslateRepositoryInterface',
        'ZnBundle\\Language\\Domain\\Entities\\LanguageEntity' => 'ZnBundle\\Language\\Domain\\Interfaces\\Repositories\\LanguageRepositoryInterface',
    ],*/
];