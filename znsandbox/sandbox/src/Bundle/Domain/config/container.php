<?php

return [
	'singletons' => [
		'ZnSandbox\\Sandbox\\Bundle\\Domain\\Interfaces\\Services\\BundleServiceInterface' => 'ZnSandbox\\Sandbox\\Bundle\\Domain\\Services\\BundleService',
		'ZnSandbox\\Sandbox\\Bundle\\Domain\\Interfaces\\Repositories\\BundleRepositoryInterface' => 'ZnSandbox\\Sandbox\\Bundle\\Domain\\Repositories\\File\\BundleRepository',
		'ZnSandbox\\Sandbox\\Bundle\\Domain\\Interfaces\\Services\\DomainServiceInterface' => 'ZnSandbox\\Sandbox\\Bundle\\Domain\\Services\\DomainService',
		'ZnSandbox\\Sandbox\\Bundle\\Domain\\Interfaces\\Repositories\\DomainRepositoryInterface' => 'ZnSandbox\\Sandbox\\Bundle\\Domain\\Repositories\\Eloquent\\DomainRepository',
	],
	/*'entities' => [
		'ZnSandbox\\Sandbox\\Bundle\\Domain\\Entities\\BundleEntity' => 'ZnSandbox\\Sandbox\\Bundle\\Domain\\Interfaces\\Repositories\\BundleRepositoryInterface',
		'ZnSandbox\\Sandbox\\Bundle\\Domain\\Entities\\DomainEntity' => 'ZnSandbox\\Sandbox\\Bundle\\Domain\\Interfaces\\Repositories\\DomainRepositoryInterface',
	],*/
];