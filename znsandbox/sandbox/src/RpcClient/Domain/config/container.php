<?php

return [
	'singletons' => [
		'ZnSandbox\\Sandbox\\RpcClient\\Domain\\Interfaces\\Services\\UserServiceInterface' => 'ZnSandbox\\Sandbox\\RpcClient\\Domain\\Services\\UserService',
		'ZnSandbox\\Sandbox\\RpcClient\\Domain\\Interfaces\\Repositories\\UserRepositoryInterface' => 'ZnSandbox\\Sandbox\\RpcClient\\Domain\\Repositories\\Eloquent\\UserRepository',
		'ZnSandbox\\Sandbox\\RpcClient\\Domain\\Interfaces\\Services\\FavoriteServiceInterface' => 'ZnSandbox\\Sandbox\\RpcClient\\Domain\\Services\\FavoriteService',
		'ZnSandbox\\Sandbox\\RpcClient\\Domain\\Interfaces\\Repositories\\FavoriteRepositoryInterface' => 'ZnSandbox\\Sandbox\\RpcClient\\Domain\\Repositories\\Eloquent\\FavoriteRepository',
		'ZnSandbox\\Sandbox\\RpcClient\\Domain\\Interfaces\\Services\\ClientServiceInterface' => 'ZnSandbox\\Sandbox\\RpcClient\\Domain\\Services\\ClientService',
	],
];