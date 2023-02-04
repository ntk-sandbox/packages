<?php

use Untek\Bundle\Storage\Domain\Libs\FileHash;

return [
    'singletons' => [
        FileHash::class => function (\Psr\Container\ContainerInterface $container) {
            /** @var \Untek\Core\App\Interfaces\EnvStorageInterface $envStorage */
            $envStorage = $container->get(\Untek\Core\App\Interfaces\EnvStorageInterface::class);
            return new FileHash(
                $envStorage->get('STORAGE_HASH_ALGORITHM'),
                $envStorage->get('STORAGE_HASH_INCLUDE_SIZE'),
                $envStorage->get('STORAGE_PATH_DIRECTORY_SIZE'),
                $envStorage->get('STORAGE_PATH_DIRECTORY_COUNT'),
                $envStorage->get('STORAGE_PATH_ENCODER')
            );
        },
        'Untek\\Bundle\\Storage\\Domain\\Interfaces\\Services\\FileServiceInterface' => 'Untek\\Bundle\\Storage\\Domain\\Services\\FileService',
        'Untek\\Bundle\\Storage\\Domain\\Interfaces\\Services\\ServiceServiceInterface' => 'Untek\\Bundle\\Storage\\Domain\\Services\\ServiceService',
        'Untek\\Bundle\\Storage\\Domain\\Interfaces\\Services\\UsageServiceInterface' => 'Untek\\Bundle\\Storage\\Domain\\Services\\UsageService',
        'Untek\\Bundle\\Storage\\Domain\\Interfaces\\Repositories\\FileRepositoryInterface' => 'Untek\\Bundle\\Storage\\Domain\\Repositories\\Eloquent\\FileRepository',
        'Untek\\Bundle\\Storage\\Domain\\Interfaces\\Repositories\\ServiceRepositoryInterface' => 'Untek\\Bundle\\Storage\\Domain\\Repositories\\Eloquent\\ServiceRepository',
        'Untek\\Bundle\\Storage\\Domain\\Interfaces\\Repositories\\UsageRepositoryInterface' => 'Untek\\Bundle\\Storage\\Domain\\Repositories\\Eloquent\\UsageRepository',
        'Untek\\Bundle\\Storage\\Domain\\Interfaces\\Services\\UploadServiceInterface' => 'Untek\\Bundle\\Storage\\Domain\\Services\\UploadService',
        'Untek\\Bundle\\Storage\\Domain\\Interfaces\\Services\\MyFileServiceInterface' => 'Untek\\Bundle\\Storage\\Domain\\Services\\MyFileService',
    ],
];