<?php

return [
	'singletons' => [
		'ZnSandbox\\Sandbox\\Application\\Domain\\Interfaces\\Services\\ApplicationServiceInterface' => 'ZnSandbox\\Sandbox\\Application\\Domain\\Services\\ApplicationService',
		'ZnSandbox\\Sandbox\\Application\\Domain\\Interfaces\\Repositories\\ApplicationRepositoryInterface' => 'ZnSandbox\\Sandbox\\Application\\Domain\\Repositories\\Eloquent\\ApplicationRepository',
		'ZnSandbox\\Sandbox\\Application\\Domain\\Interfaces\\Services\\ApiKeyServiceInterface' => 'ZnSandbox\\Sandbox\\Application\\Domain\\Services\\ApiKeyService',
		'ZnSandbox\\Sandbox\\Application\\Domain\\Interfaces\\Repositories\\ApiKeyRepositoryInterface' => 'ZnSandbox\\Sandbox\\Application\\Domain\\Repositories\\Eloquent\\ApiKeyRepository',
		'ZnSandbox\\Sandbox\\Application\\Domain\\Interfaces\\Services\\EdsServiceInterface' => 'ZnSandbox\\Sandbox\\Application\\Domain\\Services\\EdsService',
		'ZnSandbox\\Sandbox\\Application\\Domain\\Interfaces\\Repositories\\EdsRepositoryInterface' => 'ZnSandbox\\Sandbox\\Application\\Domain\\Repositories\\Eloquent\\EdsRepository',
	],
];