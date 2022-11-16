<?php

return [
    'entities' => [
        'ZnUser\\Rbac\\Domain\\Entities\\RoleEntity' => 'ZnUser\\Rbac\\Domain\\Interfaces\\Repositories\\RoleRepositoryInterface',
		'ZnUser\\Rbac\\Domain\\Entities\\InheritanceEntity' => 'ZnUser\\Rbac\\Domain\\Interfaces\\Repositories\\InheritanceRepositoryInterface',
		'ZnUser\\Rbac\\Domain\\Entities\\ItemEntity' => 'ZnUser\\Rbac\\Domain\\Interfaces\\Repositories\\ItemRepositoryInterface',
		'ZnUser\\Rbac\\Domain\\Entities\\PermissionEntity' => 'ZnUser\\Rbac\\Domain\\Interfaces\\Repositories\\PermissionRepositoryInterface',
		'ZnUser\\Rbac\\Domain\\Entities\\AssignmentEntity' => 'ZnUser\\Rbac\\Domain\\Interfaces\\Repositories\\AssignmentRepositoryInterface',
	],
];