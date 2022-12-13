<?php

return [
	'singletons' => [
        'ZnUser\\Password\\Domain\\Interfaces\\Services\\PasswordServiceInterface' => 'ZnUser\\Password\\Domain\\Services\\PasswordService',
        'ZnUser\\Password\\Domain\\Interfaces\\Services\\RestorePasswordServiceInterface' => 'ZnUser\\Password\\Domain\\Services\\RestorePasswordService',
        'ZnUser\\Password\\Domain\\Interfaces\\Services\\UpdatePasswordServiceInterface' => 'ZnUser\\Password\\Domain\\Services\\UpdatePasswordService',
		'ZnUser\\Password\\Domain\\Interfaces\\Services\\PasswordHistoryServiceInterface' => 'ZnUser\\Password\\Domain\\Services\\PasswordHistoryService',
		'ZnUser\\Password\\Domain\\Interfaces\\Repositories\\PasswordHistoryRepositoryInterface' => 'ZnUser\\Password\\Domain\\Repositories\\Eloquent\\PasswordHistoryRepository',
		'ZnUser\\Password\\Domain\\Interfaces\\Services\\PasswordValidatorServiceInterface' => 'ZnUser\\Password\\Domain\\Services\\PasswordValidatorService',
		'ZnUser\\Password\\Domain\\Interfaces\\Services\\PasswordBlacklistServiceInterface' => 'ZnUser\\Password\\Domain\\Services\\PasswordBlacklistService',
		'ZnUser\\Password\\Domain\\Interfaces\\Repositories\\PasswordBlacklistRepositoryInterface' => 'ZnUser\\Password\\Domain\\Repositories\\Eloquent\\PasswordBlacklistRepository',
	],
];