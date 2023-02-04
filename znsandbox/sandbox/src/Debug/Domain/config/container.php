<?php

return [
	'singletons' => [
		'Untek\\Sandbox\\Sandbox\\Debug\\Domain\\Interfaces\\Services\\RequestServiceInterface' => 'Untek\\Sandbox\\Sandbox\\Debug\\Domain\\Services\\RequestService',
		'Untek\\Sandbox\\Sandbox\\Debug\\Domain\\Interfaces\\Repositories\\RequestRepositoryInterface' => 'Untek\\Sandbox\\Sandbox\\Debug\\Domain\\Repositories\\Eloquent\\RequestRepository',
		'Untek\\Sandbox\\Sandbox\\Debug\\Domain\\Interfaces\\Services\\ProfilingServiceInterface' => 'Untek\\Sandbox\\Sandbox\\Debug\\Domain\\Services\\ProfilingService',
		'Untek\\Sandbox\\Sandbox\\Debug\\Domain\\Interfaces\\Repositories\\ProfilingRepositoryInterface' => 'Untek\\Sandbox\\Sandbox\\Debug\\Domain\\Repositories\\Eloquent\\ProfilingRepository',
	],
];