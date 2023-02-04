<?php

return [
	'singletons' => [
		'Untek\\Sandbox\\Sandbox\\Bundle\\Domain\\Interfaces\\Services\\BundleServiceInterface' => 'Untek\\Sandbox\\Sandbox\\Bundle\\Domain\\Services\\BundleService',
		'Untek\\Sandbox\\Sandbox\\Bundle\\Domain\\Interfaces\\Repositories\\BundleRepositoryInterface' => 'Untek\\Sandbox\\Sandbox\\Bundle\\Domain\\Repositories\\File\\BundleRepository',
		'Untek\\Sandbox\\Sandbox\\Bundle\\Domain\\Interfaces\\Services\\DomainServiceInterface' => 'Untek\\Sandbox\\Sandbox\\Bundle\\Domain\\Services\\DomainService',
		'Untek\\Sandbox\\Sandbox\\Bundle\\Domain\\Interfaces\\Repositories\\DomainRepositoryInterface' => 'Untek\\Sandbox\\Sandbox\\Bundle\\Domain\\Repositories\\Eloquent\\DomainRepository',
	],
];