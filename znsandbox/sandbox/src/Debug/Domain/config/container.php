<?php

return [
	'singletons' => [
		'ZnSandbox\\Sandbox\\Debug\\Domain\\Interfaces\\Services\\RequestServiceInterface' => 'ZnSandbox\\Sandbox\\Debug\\Domain\\Services\\RequestService',
		'ZnSandbox\\Sandbox\\Debug\\Domain\\Interfaces\\Repositories\\RequestRepositoryInterface' => 'ZnSandbox\\Sandbox\\Debug\\Domain\\Repositories\\Eloquent\\RequestRepository',
		'ZnSandbox\\Sandbox\\Debug\\Domain\\Interfaces\\Services\\ProfilingServiceInterface' => 'ZnSandbox\\Sandbox\\Debug\\Domain\\Services\\ProfilingService',
		'ZnSandbox\\Sandbox\\Debug\\Domain\\Interfaces\\Repositories\\ProfilingRepositoryInterface' => 'ZnSandbox\\Sandbox\\Debug\\Domain\\Repositories\\Eloquent\\ProfilingRepository',
	],
	/*'entities' => [
		'ZnSandbox\\Sandbox\\Debug\\Domain\\Entities\\RequestEntity' => 'ZnSandbox\\Sandbox\\Debug\\Domain\\Interfaces\\Repositories\\RequestRepositoryInterface',
		'ZnSandbox\\Sandbox\\Debug\\Domain\\Entities\\ProfilingEntity' => 'ZnSandbox\\Sandbox\\Debug\\Domain\\Interfaces\\Repositories\\ProfilingRepositoryInterface',
	],*/
];