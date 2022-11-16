<?php

use ZnDomain\EntityManager\Interfaces\EntityManagerConfiguratorInterface;

return function (EntityManagerConfiguratorInterface $entityManagerConfigurator) {
    $entityManagerConfigurator->bindEntity('ZnUser\\Rbac\\Domain\\Entities\\RoleEntity', 'ZnUser\\Rbac\\Domain\\Interfaces\\Repositories\\RoleRepositoryInterface');
    $entityManagerConfigurator->bindEntity('ZnUser\\Rbac\\Domain\\Entities\\InheritanceEntity', 'ZnUser\\Rbac\\Domain\\Interfaces\\Repositories\\InheritanceRepositoryInterface');
    $entityManagerConfigurator->bindEntity('ZnUser\\Rbac\\Domain\\Entities\\ItemEntity', 'ZnUser\\Rbac\\Domain\\Interfaces\\Repositories\\ItemRepositoryInterface');
    $entityManagerConfigurator->bindEntity('ZnUser\\Rbac\\Domain\\Entities\\ItemEntity', 'ZnUser\\Rbac\\Domain\\Interfaces\\Repositories\\ItemRepositoryInterface');
    $entityManagerConfigurator->bindEntity('ZnUser\\Rbac\\Domain\\Entities\\PermissionEntity', 'ZnUser\\Rbac\\Domain\\Interfaces\\Repositories\\PermissionRepositoryInterface');
    $entityManagerConfigurator->bindEntity('ZnUser\\Rbac\\Domain\\Entities\\AssignmentEntity', 'ZnUser\\Rbac\\Domain\\Interfaces\\Repositories\\AssignmentRepositoryInterface');
};
