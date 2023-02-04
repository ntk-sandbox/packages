<?php

return [
	'singletons' => [
		'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Services\\UserServiceInterface' => 'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Services\\UserService',
		'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Repositories\\UserRepositoryInterface' => 'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Repositories\\Eloquent\\UserRepository',
		'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Services\\ProjectServiceInterface' => 'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Services\\ProjectService',
		'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Repositories\\ProjectRepositoryInterface' => 'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Repositories\\Eloquent\\ProjectRepository',
		'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Services\\TrackerServiceInterface' => 'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Services\\TrackerService',
		'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Repositories\\TrackerRepositoryInterface' => 'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Repositories\\Eloquent\\TrackerRepository',
		'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Services\\StatusServiceInterface' => 'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Services\\StatusService',
		'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Repositories\\StatusRepositoryInterface' => 'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Repositories\\Eloquent\\StatusRepository',
		'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Services\\PriorityServiceInterface' => 'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Services\\PriorityService',
		'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Repositories\\PriorityRepositoryInterface' => 'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Repositories\\Eloquent\\PriorityRepository',
		'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Services\\IssueServiceInterface' => 'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Services\\IssueService',
		'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Repositories\\IssueRepositoryInterface' => 'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Repositories\\Eloquent\\IssueRepository',
		'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Services\\IssueApiServiceInterface' => 'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Services\\IssueApiService',
		'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Repositories\\IssueApiRepositoryInterface' => 'Untek\\Sandbox\\Sandbox\\Redmine\\Domain\\Repositories\\Api\\IssueApiRepository',
	],
];