<?php

return [
	'singletons' => [
		'Untek\\Sandbox\\Sandbox\\RpcClient\\Domain\\Interfaces\\Services\\UserServiceInterface' => 'Untek\\Sandbox\\Sandbox\\RpcClient\\Domain\\Services\\UserService',
		'Untek\\Sandbox\\Sandbox\\RpcClient\\Domain\\Interfaces\\Repositories\\UserRepositoryInterface' => 'Untek\\Sandbox\\Sandbox\\RpcClient\\Domain\\Repositories\\Eloquent\\UserRepository',
		'Untek\\Sandbox\\Sandbox\\RpcClient\\Domain\\Interfaces\\Services\\FavoriteServiceInterface' => 'Untek\\Sandbox\\Sandbox\\RpcClient\\Domain\\Services\\FavoriteService',
		'Untek\\Sandbox\\Sandbox\\RpcClient\\Domain\\Interfaces\\Repositories\\FavoriteRepositoryInterface' => 'Untek\\Sandbox\\Sandbox\\RpcClient\\Domain\\Repositories\\Eloquent\\FavoriteRepository',
		'Untek\\Sandbox\\Sandbox\\RpcClient\\Domain\\Interfaces\\Services\\ClientServiceInterface' => 'Untek\\Sandbox\\Sandbox\\RpcClient\\Domain\\Services\\ClientService',
	],
];