<?php

return [
    'entities' => [
        'Untek\\User\\Rbac\\Domain\\Entities\\RoleEntity' => 'Untek\\User\\Rbac\\Domain\\Interfaces\\Repositories\\RoleRepositoryInterface',
		'Untek\\User\\Rbac\\Domain\\Entities\\InheritanceEntity' => 'Untek\\User\\Rbac\\Domain\\Interfaces\\Repositories\\InheritanceRepositoryInterface',
		'Untek\\User\\Rbac\\Domain\\Entities\\ItemEntity' => 'Untek\\User\\Rbac\\Domain\\Interfaces\\Repositories\\ItemRepositoryInterface',
		'Untek\\User\\Rbac\\Domain\\Entities\\PermissionEntity' => 'Untek\\User\\Rbac\\Domain\\Interfaces\\Repositories\\PermissionRepositoryInterface',
		'Untek\\User\\Rbac\\Domain\\Entities\\AssignmentEntity' => 'Untek\\User\\Rbac\\Domain\\Interfaces\\Repositories\\AssignmentRepositoryInterface',
	],
];