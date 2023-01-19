<?php

use ZnBundle\Storage\Domain\Libs\FileHash;

return [
	'singletons' => [
        FileHash::class => function () {
            return new FileHash(getenv('STORAGE_HASH_ALGORITHM'), getenv('STORAGE_HASH_INCLUDE_SIZE'), getenv('STORAGE_PATH_DIRECTORY_SIZE'), getenv('STORAGE_PATH_DIRECTORY_COUNT'), getenv('STORAGE_PATH_ENCODER'));
        },
		'ZnBundle\\Storage\\Domain\\Interfaces\\Services\\FileServiceInterface' => 'ZnBundle\\Storage\\Domain\\Services\\FileService',
		'ZnBundle\\Storage\\Domain\\Interfaces\\Services\\ServiceServiceInterface' => 'ZnBundle\\Storage\\Domain\\Services\\ServiceService',
		'ZnBundle\\Storage\\Domain\\Interfaces\\Services\\UsageServiceInterface' => 'ZnBundle\\Storage\\Domain\\Services\\UsageService',
		'ZnBundle\\Storage\\Domain\\Interfaces\\Repositories\\FileRepositoryInterface' => 'ZnBundle\\Storage\\Domain\\Repositories\\Eloquent\\FileRepository',
		'ZnBundle\\Storage\\Domain\\Interfaces\\Repositories\\ServiceRepositoryInterface' => 'ZnBundle\\Storage\\Domain\\Repositories\\Eloquent\\ServiceRepository',
		'ZnBundle\\Storage\\Domain\\Interfaces\\Repositories\\UsageRepositoryInterface' => 'ZnBundle\\Storage\\Domain\\Repositories\\Eloquent\\UsageRepository',
		'ZnBundle\\Storage\\Domain\\Interfaces\\Services\\UploadServiceInterface' => 'ZnBundle\\Storage\\Domain\\Services\\UploadService',
		'ZnBundle\\Storage\\Domain\\Interfaces\\Services\\MyFileServiceInterface' => 'ZnBundle\\Storage\\Domain\\Services\\MyFileService',
	],
];