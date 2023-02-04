<?php

use Untek\Core\Env\Helpers\EnvHelper;

return [
    'singletons' => [
        'Untek\\Bundle\\Language\\Domain\\Interfaces\\Services\\LanguageServiceInterface' => 'Untek\\Bundle\\Language\\Domain\\Services\\LanguageService',
        'Untek\\Bundle\\Language\\Domain\\Interfaces\\Services\\RuntimeLanguageServiceInterface' => 'Untek\\Bundle\\Language\\Domain\\Services\\RuntimeLanguageService',
        'Untek\\Bundle\\Language\\Domain\\Interfaces\\Repositories\\LanguageRepositoryInterface' => 'Untek\\Bundle\\Language\\Domain\\Repositories\\Eloquent\\LanguageRepository',
        'Untek\\Bundle\\Language\\Domain\\Interfaces\\Repositories\\SwitchRepositoryInterface' => EnvHelper::isConsole() ? 'Untek\\Bundle\\Language\\Domain\\Repositories\\Console\\SwitchRepository' : 'Untek\\Bundle\\Language\\Domain\\Repositories\\Symfony4\\SwitchRepository',
        'Untek\\Bundle\\Language\\Domain\\Interfaces\\Repositories\\StorageRepositoryInterface' => EnvHelper::isConsole() ? 'Untek\\Bundle\\Language\\Domain\\Repositories\\Console\\StorageRepository' : 'Untek\\Bundle\\Language\\Domain\\Repositories\\Symfony4\\StorageRepository',
        'Untek\\Bundle\\Language\\Domain\\Interfaces\\Services\\BundleServiceInterface' => 'Untek\\Bundle\\Language\\Domain\\Services\\BundleService',
        'Untek\\Bundle\\Language\\Domain\\Interfaces\\Repositories\\BundleRepositoryInterface' => 'Untek\\Bundle\\Language\\Domain\\Repositories\\Eloquent\\BundleRepository',
        'Untek\\Bundle\\Language\\Domain\\Interfaces\\Services\\TranslateServiceInterface' => 'Untek\\Bundle\\Language\\Domain\\Services\\TranslateService',
        'Untek\\Bundle\\Language\\Domain\\Interfaces\\Repositories\\TranslateRepositoryInterface' => 'Untek\\Bundle\\Language\\Domain\\Repositories\\Eloquent\\TranslateRepository',
    ],
];