<?php

return [
	'singletons' => [
        'Untek\\Bundle\\Queue\\Domain\\Interfaces\\Services\\JobServiceInterface' => 'Untek\\Bundle\\Queue\\Domain\\Services\\JobService',
        'Untek\\Bundle\\Queue\\Domain\\Interfaces\\Repositories\\JobRepositoryInterface' => 'Untek\\Bundle\\Queue\\Domain\\Repositories\\Eloquent\\JobRepository',
		'Untek\\Bundle\\Queue\\Domain\\Interfaces\\Services\\ScheduleServiceInterface' => 'Untek\\Bundle\\Queue\\Domain\\Services\\ScheduleService',
		'Untek\\Bundle\\Queue\\Domain\\Interfaces\\Repositories\\ScheduleRepositoryInterface' => 'Untek\\Bundle\\Queue\\Domain\\Repositories\\Eloquent\\ScheduleRepository',
	],
];