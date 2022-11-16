<?php

return [
	'entities' => [
		'ZnSandbox\\Sandbox\\Redmine\\Domain\\Entities\\UserEntity' => 'ZnSandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Repositories\\UserRepositoryInterface',
		'ZnSandbox\\Sandbox\\Redmine\\Domain\\Entities\\ProjectEntity' => 'ZnSandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Repositories\\ProjectRepositoryInterface',
		'ZnSandbox\\Sandbox\\Redmine\\Domain\\Entities\\TrackerEntity' => 'ZnSandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Repositories\\TrackerRepositoryInterface',
		'ZnSandbox\\Sandbox\\Redmine\\Domain\\Entities\\StatusEntity' => 'ZnSandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Repositories\\StatusRepositoryInterface',
		'ZnSandbox\\Sandbox\\Redmine\\Domain\\Entities\\PriorityEntity' => 'ZnSandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Repositories\\PriorityRepositoryInterface',
		'ZnSandbox\\Sandbox\\Redmine\\Domain\\Entities\\IssueEntity' => 'ZnSandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Repositories\\IssueRepositoryInterface',
		'ZnSandbox\\Sandbox\\Redmine\\Domain\\Entities\\IssueApiEntity' => 'ZnSandbox\\Sandbox\\Redmine\\Domain\\Interfaces\\Repositories\\IssueApiRepositoryInterface',
	],
];