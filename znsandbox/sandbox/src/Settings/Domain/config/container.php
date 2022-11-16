<?php

return [
	'singletons' => [
		'ZnSandbox\\Sandbox\\Settings\\Domain\\Interfaces\\Services\\SystemServiceInterface' => 'ZnSandbox\\Sandbox\\Settings\\Domain\\Services\\SystemService',
		'ZnSandbox\\Sandbox\\Settings\\Domain\\Interfaces\\Repositories\\SystemRepositoryInterface' => 'ZnSandbox\\Sandbox\\Settings\\Domain\\Repositories\\Eloquent\\SystemRepository',
	],
	/*'entities' => [
		'ZnSandbox\\Sandbox\\Settings\\Domain\\Entities\\SystemEntity' => 'ZnSandbox\\Sandbox\\Settings\\Domain\\Interfaces\\Repositories\\SystemRepositoryInterface',
	],*/
];