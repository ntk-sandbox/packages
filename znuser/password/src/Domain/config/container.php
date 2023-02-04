<?php

return [
	'singletons' => [
        'Untek\\User\\Password\\Domain\\Interfaces\\Services\\PasswordServiceInterface' => 'Untek\\User\\Password\\Domain\\Services\\PasswordService',
        'Untek\\User\\Password\\Domain\\Interfaces\\Services\\RestorePasswordServiceInterface' => 'Untek\\User\\Password\\Domain\\Services\\RestorePasswordService',
        'Untek\\User\\Password\\Domain\\Interfaces\\Services\\UpdatePasswordServiceInterface' => 'Untek\\User\\Password\\Domain\\Services\\UpdatePasswordService',
		'Untek\\User\\Password\\Domain\\Interfaces\\Services\\PasswordHistoryServiceInterface' => 'Untek\\User\\Password\\Domain\\Services\\PasswordHistoryService',
		'Untek\\User\\Password\\Domain\\Interfaces\\Repositories\\PasswordHistoryRepositoryInterface' => 'Untek\\User\\Password\\Domain\\Repositories\\Eloquent\\PasswordHistoryRepository',
		'Untek\\User\\Password\\Domain\\Interfaces\\Services\\PasswordValidatorServiceInterface' => 'Untek\\User\\Password\\Domain\\Services\\PasswordValidatorService',
		'Untek\\User\\Password\\Domain\\Interfaces\\Services\\PasswordBlacklistServiceInterface' => 'Untek\\User\\Password\\Domain\\Services\\PasswordBlacklistService',
		'Untek\\User\\Password\\Domain\\Interfaces\\Repositories\\PasswordBlacklistRepositoryInterface' => 'Untek\\User\\Password\\Domain\\Repositories\\Eloquent\\PasswordBlacklistRepository',
	],
];