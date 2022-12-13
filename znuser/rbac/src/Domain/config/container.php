<?php

return [
    'singletons' => [
        'ZnUser\\Rbac\\Domain\\Interfaces\\Services\\RoleServiceInterface' => 'ZnUser\\Rbac\\Domain\\Services\\RoleService',
        'ZnUser\\Rbac\\Domain\\Interfaces\\Services\\ManagerServiceInterface' => 'ZnUser\\Rbac\\Domain\\Services\\ManagerService',
        'ZnUser\\Rbac\\Domain\\Interfaces\\Services\\InheritanceServiceInterface' => 'ZnUser\\Rbac\\Domain\\Services\\InheritanceService',
        'ZnUser\\Rbac\\Domain\\Interfaces\\Repositories\\ManagerRepositoryInterface' => 'ZnUser\\Rbac\\Domain\\Repositories\\File\\ManagerRepository',
        'ZnUser\\Rbac\\Domain\\Interfaces\\Services\\ItemServiceInterface' => 'ZnUser\\Rbac\\Domain\\Services\\ItemService',
        'ZnUser\\Rbac\\Domain\\Interfaces\\Services\\PermissionServiceInterface' => 'ZnUser\\Rbac\\Domain\\Services\\PermissionService',
        'ZnUser\\Rbac\\Domain\\Interfaces\\Services\\AssignmentServiceInterface' => 'ZnUser\\Rbac\\Domain\\Services\\AssignmentService',
        'ZnUser\\Rbac\\Domain\\Interfaces\\Repositories\\AssignmentRepositoryInterface' => 'ZnUser\\Rbac\\Domain\\Repositories\\Eloquent\\AssignmentRepository',
        'ZnUser\\Rbac\\Domain\\Interfaces\\Services\\MyAssignmentServiceInterface' => 'ZnUser\\Rbac\\Domain\\Services\\MyAssignmentService',
    ],
];