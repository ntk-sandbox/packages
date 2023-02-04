<?php

return [
    'singletons' => [
        'Untek\\User\\Rbac\\Domain\\Interfaces\\Services\\RoleServiceInterface' => 'Untek\\User\\Rbac\\Domain\\Services\\RoleService',
        'Untek\\User\\Rbac\\Domain\\Interfaces\\Services\\ManagerServiceInterface' => 'Untek\\User\\Rbac\\Domain\\Services\\ManagerService',
        'Untek\\User\\Rbac\\Domain\\Interfaces\\Services\\InheritanceServiceInterface' => 'Untek\\User\\Rbac\\Domain\\Services\\InheritanceService',
        'Untek\\User\\Rbac\\Domain\\Interfaces\\Repositories\\ManagerRepositoryInterface' => 'Untek\\User\\Rbac\\Domain\\Repositories\\File\\ManagerRepository',
        'Untek\\User\\Rbac\\Domain\\Interfaces\\Services\\ItemServiceInterface' => 'Untek\\User\\Rbac\\Domain\\Services\\ItemService',
        'Untek\\User\\Rbac\\Domain\\Interfaces\\Services\\PermissionServiceInterface' => 'Untek\\User\\Rbac\\Domain\\Services\\PermissionService',
        'Untek\\User\\Rbac\\Domain\\Interfaces\\Services\\AssignmentServiceInterface' => 'Untek\\User\\Rbac\\Domain\\Services\\AssignmentService',
        'Untek\\User\\Rbac\\Domain\\Interfaces\\Repositories\\AssignmentRepositoryInterface' => 'Untek\\User\\Rbac\\Domain\\Repositories\\Eloquent\\AssignmentRepository',
        'Untek\\User\\Rbac\\Domain\\Interfaces\\Services\\MyAssignmentServiceInterface' => 'Untek\\User\\Rbac\\Domain\\Services\\MyAssignmentService',
    ],
];