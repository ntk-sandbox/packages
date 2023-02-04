<?php

return [
	'singletons' => [
		'Untek\\Sandbox\\Sandbox\\Application\\Domain\\Interfaces\\Services\\ApplicationServiceInterface' => 'Untek\\Sandbox\\Sandbox\\Application\\Domain\\Services\\ApplicationService',
		'Untek\\Sandbox\\Sandbox\\Application\\Domain\\Interfaces\\Repositories\\ApplicationRepositoryInterface' => 'Untek\\Sandbox\\Sandbox\\Application\\Domain\\Repositories\\Eloquent\\ApplicationRepository',
		'Untek\\Sandbox\\Sandbox\\Application\\Domain\\Interfaces\\Services\\ApiKeyServiceInterface' => 'Untek\\Sandbox\\Sandbox\\Application\\Domain\\Services\\ApiKeyService',
		'Untek\\Sandbox\\Sandbox\\Application\\Domain\\Interfaces\\Repositories\\ApiKeyRepositoryInterface' => 'Untek\\Sandbox\\Sandbox\\Application\\Domain\\Repositories\\Eloquent\\ApiKeyRepository',
		'Untek\\Sandbox\\Sandbox\\Application\\Domain\\Interfaces\\Services\\EdsServiceInterface' => 'Untek\\Sandbox\\Sandbox\\Application\\Domain\\Services\\EdsService',
		'Untek\\Sandbox\\Sandbox\\Application\\Domain\\Interfaces\\Repositories\\EdsRepositoryInterface' => 'Untek\\Sandbox\\Sandbox\\Application\\Domain\\Repositories\\Eloquent\\EdsRepository',
	],
];