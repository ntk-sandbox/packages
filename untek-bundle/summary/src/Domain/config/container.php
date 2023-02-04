<?php

return [
	'singletons' => [
		'Untek\\Bundle\\Summary\\Domain\\Interfaces\\Services\\CounterServiceInterface' => 'Untek\\Bundle\\Summary\\Domain\\Services\\CounterService',
		'Untek\\Bundle\\Summary\\Domain\\Interfaces\\Repositories\\CounterRepositoryInterface' => 'Untek\\Bundle\\Summary\\Domain\\Repositories\\Eloquent\\CounterRepository',
		'Untek\\Bundle\\Summary\\Domain\\Interfaces\\Services\\AttemptServiceInterface' => 'Untek\\Bundle\\Summary\\Domain\\Services\\AttemptService',
		'Untek\\Bundle\\Summary\\Domain\\Interfaces\\Repositories\\AttemptRepositoryInterface' => 'Untek\\Bundle\\Summary\\Domain\\Repositories\\Eloquent\\AttemptRepository',
	],
];