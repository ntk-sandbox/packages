<?php

return [
	'singletons' => [
		'ZnBundle\\Summary\\Domain\\Interfaces\\Services\\CounterServiceInterface' => 'ZnBundle\\Summary\\Domain\\Services\\CounterService',
		'ZnBundle\\Summary\\Domain\\Interfaces\\Repositories\\CounterRepositoryInterface' => 'ZnBundle\\Summary\\Domain\\Repositories\\Eloquent\\CounterRepository',
		'ZnBundle\\Summary\\Domain\\Interfaces\\Services\\AttemptServiceInterface' => 'ZnBundle\\Summary\\Domain\\Services\\AttemptService',
		'ZnBundle\\Summary\\Domain\\Interfaces\\Repositories\\AttemptRepositoryInterface' => 'ZnBundle\\Summary\\Domain\\Repositories\\Eloquent\\AttemptRepository',
	],
	/*'entities' => [
		'ZnBundle\\Summary\\Domain\\Entities\\AttemptEntity' => 'ZnBundle\\Summary\\Domain\\Interfaces\\Repositories\\AttemptRepositoryInterface',
	],*/
];