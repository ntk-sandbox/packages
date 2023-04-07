<?php

use Untek\Model\EntityManager\Interfaces\EntityManagerConfiguratorInterface;

return function (EntityManagerConfiguratorInterface $entityManagerConfigurator) {
    $entityManagerConfigurator->bindEntity('Untek\\User\\Rbac\\Domain\\Entities\\RoleEntity', 'Untek\\User\\Rbac\\Domain\\Interfaces\\Repositories\\RoleRepositoryInterface');
    $entityManagerConfigurator->bindEntity('Untek\\User\\Rbac\\Domain\\Entities\\InheritanceEntity', 'Untek\\User\\Rbac\\Domain\\Interfaces\\Repositories\\InheritanceRepositoryInterface');
    $entityManagerConfigurator->bindEntity('Untek\\User\\Rbac\\Domain\\Entities\\ItemEntity', 'Untek\\User\\Rbac\\Domain\\Interfaces\\Repositories\\ItemRepositoryInterface');
    $entityManagerConfigurator->bindEntity('Untek\\User\\Rbac\\Domain\\Entities\\ItemEntity', 'Untek\\User\\Rbac\\Domain\\Interfaces\\Repositories\\ItemRepositoryInterface');
    $entityManagerConfigurator->bindEntity('Untek\\User\\Rbac\\Domain\\Entities\\PermissionEntity', 'Untek\\User\\Rbac\\Domain\\Interfaces\\Repositories\\PermissionRepositoryInterface');
    $entityManagerConfigurator->bindEntity('Untek\\User\\Rbac\\Domain\\Entities\\AssignmentEntity', 'Untek\\User\\Rbac\\Domain\\Interfaces\\Repositories\\AssignmentRepositoryInterface');
};
